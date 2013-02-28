<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompleteSourceListener: This listener will be assigned to the entity by the AutoCoompletable bhavior, 
 * This listner will listen to the insert and delete events, and responds to these two events based based if this entity has any foreign relation or not.
 * 1- In case there is a foreign relation: 
 *      a. Insert event: in case the tuple (name, foreignid) exists then it'll just increasse the score by one. otherwise it'll check for the foeignid if it's 
 *      null it'll add a new record with score=1 otherwise it'll add a new record with score=50.
 *      b. Delete Event: in case the typle (name, foreignid) exists and the forreignid is not null, then don't delete the record just decrement the score by defaultScore
 *      and block the delete operation. otherwise do nothing.
 * 2- In case there is no foreign relation:
 *      a. Insert event: always look for the name, if it exists increase the score by one and stop the insert event, otherwise add a new record with score=1.
 *      b. Delete event: Do nothing on delete
 * 
 * 
 * Currently this listner assumes that the entity has no or one foreign relation.
 *
 * @author mustafa
 */
class AutoCompleteSourceListener extends Doctrine_Record_Listener{
   protected $_options = array();

    public function __construct(array $options) {
        $this->_options=$options;
    }
    
    
    public function preInsert(Doctrine_Event $event) {
        $invoker=$event->getInvoker();
        if(isset($this->_options['relation'] ))
        {
            foreach ($this->_options['relation'] as $relation => $options)
            {
                $relation=$invoker->getTable()->getRelation($relation);
                $columnName=$relation['local'];
                if($invoker->hasRelation($columnName))
                {
                    if(!is_null($invoker->get($columnName)))
                    {
                        $query=$invoker->getTable()->createQuery();
                        $local=$relation['local'];
                        $query->addWhere($local.'=?',$invoker->get($columnName));
                        $results=$query->execute();
                        if(count($results)>0)
                        {
                            $record=$results->getFirst();
                            if(($record->getName()!=$invoker->getName() && !is_null($invoker->getName())))
                            {
                                //in case the name of the parent object changed
                                $record->setName($invoker->getName());
                            }else{
                                //in case a new parent object has been inserted.
                                
                                $record->setScore($record->getScore()+1);
                                
                            }
                            $record->save();
                            $event->skipOperation();
                            return true;
                        }else{
                            if(is_null($invoker->getScore()))
                            {

                                $invoker->setScore($options['defaultScore']);
                                return true;
                            }
                        }

                    }
                }
            }
        }  
        
        $query=$invoker->getTable()->createQuery();
        $query->addWhere("name=?",$invoker->getName());
        if(isset($columnName) && !is_null($columnName))
        {
            $query->addWhere("$columnName is null");
        }
        $results=$query->execute();
        if(count($results)>0)
        {
            $record=$results->getFirst();
            $record->setScore($record->getScore()+1);
            $record->save();
            $event->skipOperation();
        }else{
             if(is_null($invoker->getScore()))
             {
                 $invoker->setScore(1);
             }

        }
   }
    
   
   
   
   public function preDelete(Doctrine_Event $event) {
       $invoker=$event->getInvoker();
       if(isset($this->_options['relation'] ))
        {
            foreach ($this->_options['relation'] as $relation => $options)
            {
                $relation=$invoker->getTable()->getRelation($relation);
                $columnName=$relation['local'];
                if($invoker->hasRelation($columnName))
                {
                    if(!is_null($invoker->get($columnName)))
                    {
                        $query=$invoker->getTable()->createQuery();
                        $local=$relation['local'];
                        $query->addWhere($local.'=?',$invoker->get($columnName));
                        
                        $results=$query->execute();
                        if(count($results)>0)
                        {
                            
                            $record=$results->getFirst();
                            $query=$invoker->getTable()->createQuery();
                            $query->addWhere("name=?",$invoker->getName());
                            $query->andWhere("$local is null");
                            $res=$query->execute();
                            if(count($res)>0)
                            {
                                $rec=$res->getFirst();
                                $rec->setScore($rec->getScore()+($invoker->getScore()-$options['defaultScore']));
                                $rec->save();
                            }else{
                                $record->setScore($invoker->getScore()-$options['defaultScore']);
                                $record->save();
                                $event->skipOperation();
                            }
                            
                            
                            
                            
                            
                        }

                    }
                }
            }
        }  

   }
}

?>

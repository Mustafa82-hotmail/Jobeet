<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompleteSourceListener
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
                        //$query->addWhere("name=?",$invoker->getName());
                        $local=$relation['local'];
                        $query->addWhere($local.'=?',$invoker->get($columnName));
                        $results=$query->execute();
                        if(count($results)>0)
                        {
                            $record=$results->getFirst();
                            if($record->getName()!=$invoker->getName())
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
       //parent::preDelete($event);
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
                        //$query->addWhere("name=?",$invoker->getName());
                        $local=$relation['local'];
                        $query->addWhere($local.'=?',$invoker->get($columnName));
                        $results=$query->execute();
                        if(count($results)>0)
                        {
                            $record=$results->getFirst();
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

?>

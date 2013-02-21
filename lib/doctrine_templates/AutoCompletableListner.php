<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompletableListner
 *
 * @author mustafa
 */
class AutoCompletableListner extends Doctrine_Record_Listener{
    //put your code here
     protected $_options;
 
     public function __construct(array $options)
     {
          $this->_options = $options;
     }
     
     public function preInsert(Doctrine_Event $event)
     {
        $invoker=$event->getInvoker();
        foreach($this->_options as $relation => $options)
        {
            $foreignTable=Doctrine::getTable($relation['className']);
            $relation=$foreignTable->getRelation($options['foreignAlias']);
            if(is_null($invoker->$relation['foreign']))
            {
                $nameAttribute=$this->_options['stringColumn'];
                $scoreAttribute=$this->_options['scoreColumn'];
                $name=$invoker->getAttribute($nameAttribute);
                $q=$invoker->getTable()->createQuery('c')
                        ->where("$attribute = ?",$name)
                        ->andWhere("$scoreAttribute is null");
                $results=$q->execute();
                if(count($results)>0)
                {
                    $event->skipOperation();
                }
                else
                {
                    
                }
                    
                    
                
                
                
            }
            else
            {
                
            }
    
        }
        //$this->_options['relations']['']
     }
}

?>

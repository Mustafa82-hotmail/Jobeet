<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompleteUpdateListner
 *
 * @author mustafa
 */
class AutoCompleteUpdateListner extends Doctrine_Record_Listener{
   protected $_options = array();

    //put your code here
    public function __construct(array $options) {
        $this->_options=$options;
    }
    public function postInsert(Doctrine_Event $event) {
        $invoker=$event->getInvoker();
        if(isset($this->_options['className']))
        {
            $record=new $this->_options['className'];
            if($record->getTable()->hasTemplate("Mus_AutoCompletable"))
            {
                $relation=$record->getTable()->getRelation(get_class($invoker));
                $local=$relation['local'];
                $foreign=$relation['foreign'];
                $foreignClass=$relation['class'];
                $record->setName($invoker->get($this->_options['autoCompleteField']));
                $set="set".$foreignClass;
                $record->$set($invoker);
                $record->setPost($invoker);
                $record->save();
            }
            
        }else{
            trigger_error("No Autocomplete source class name found");
        }
        
    }
    
    
    public function postUpdate(Doctrine_Event $event) {
        $invoker=$event->getInvoker();
        if(isset($this->_options['className']))
        {
            $record=new $this->_options['className'];
            if($record->getTable()->hasTemplate("Mus_AutoCompletable"))
            {
                $relation=$record->getTable()->getRelation(get_class($invoker));
                $local=$relation['local'];
                $foreign=$relation['foreign'];
                $foreignClass=$relation['class'];
                $record->setName($invoker->get($this->_options['autoCompleteField']));
                $set="set".$foreignClass;
                $record->$set($invoker);
                $record->setPost($invoker);
                $record->save();
            }
            
        }else{
            trigger_error("No Autocomplete source class name found");
        }
    }
    
    
    public function preDelete(Doctrine_Event $event) {
        $invoker=$event->getInvoker();
        
        if(isset($this->_options['className']))
        {
            $record=new $this->_options['className'];
            if($record->getTable()->hasTemplate("Mus_AutoCompletable"))
            {
                
                $relation=$record->getTable()->getRelation(get_class($invoker));
                $record->getTable()->findBy($relation['local'], $invoker->get($relation['foreign']));
                if(!is_null($record))
                {
                    $record->delete();
                }
                //$record->getTable()->findOneBy$relation['local'];
                //echo $relation;die();
                //$alias=$relation['foreignAlias'];
                ///$record=$invoker->getAttribute($alias);
                //$record->delete();
            }
            
        }else{
            trigger_error("No Autocomplete source class name found");
        }
        
    }
    
}

?>

<?php

/**
 * Description of AutoCompleteUpdateListner: This listner will be used with all AutoCompleteSource entities. 
 * This listner will expect in it's options a className of the autocompletable entity associated with it. Based on inserting, updating or deleting records
 * the listner will call the appropriate method form the autocompletable class.
 *
 * @author mustafa
 */
class AutoCompleteUpdateListner extends Doctrine_Record_Listener{
   protected $_options = array();

    public function __construct(array $options) {
        $this->_options=$options;
    }
    
    public function postInsert(Doctrine_Event $event) {
        $invoker=$event->getInvoker();
        if(isset($this->_options['className']))
        {
            $record=new $this->_options['className'];
            if($record->getTable()->hasTemplate("AutoCompletable"))
            {
                $relation=null;
                foreach($record->getTable()->getRelations() as $rel)
                {
                    if($rel['class']==get_class($invoker))
                    {
                        $relation=$rel;
                    }
                }
                if(!is_null($relation))
                {
                    $local=$relation['local'];
                    $foreign=$relation['foreign'];
                    $record->setName($invoker->get($this->_options['autoCompleteField']));
                    $set="set".$relation['class'];
                    $record->$set($invoker);
                    $record->save();
                }else{
                    trigger_error("No relation found between the sourceautocomplete class and this class.");
                }
                
                
            }
            
        }else{
            trigger_error("No Autocomplete source class name found");
        }
        
    }
    
    
    public function postUpdate(Doctrine_Event $event) {
       $this->postInsert($event);
    }
    
    public function preDelete(Doctrine_Event $event) {
        $invoker=$event->getInvoker();
        if(isset($this->_options['className']))
        {
            $record=new $this->_options['className'];
            if($record->getTable()->hasTemplate("AutoCompletable"))
            {
                
                
                
                $relation=null;
                foreach($record->getTable()->getRelations() as $rel)
                {
                    if($rel['class']==get_class($invoker))
                    {
                        $relation=$rel;
                    }
                }
                
                if(!is_null($relation))
                {
                    $relation=$record->getTable()->getRelation(get_class($invoker));
                    $record=$record->getTable()->findBy($relation['local'], $invoker->get($relation['foreign']));
                    if(!is_null($record))
                    {
                        $record->delete();
                    }
                }else{
                    trigger_error("No relation found between the sourceautocomplete class and this class.");
                }
               
            }
            
        }else{
            trigger_error("No Autocomplete source class name found");
        }
        
    }
    
}

?>

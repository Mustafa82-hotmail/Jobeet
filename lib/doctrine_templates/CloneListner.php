<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CloneListner
 *
 * @author mustafa
 */
class CloneListner extends Doctrine_Record_Listener
{
  protected $_options;
  public function __construct(array $options)
  {
    $this->_options = $options;
  }
  public function postInsert(Doctrine_Event $event) 
  {
      
      $invoker=$event->getInvoker();
      $className=$this->_options['className'];
      $obj=new $className();
      
      foreach($this->_options['clonedFields'] as $col)
      {
          $obj->set($col,$invoker->get($col));
      }
     // $obj->save();
      //$methodName=$this->_options['methodName'];
      //echo $methodName;die();
      $methodName=$this->_options['methodName'];
      $obj->$methodName($this->_options['clonedFields']);
      
  }
  
  
  
  
  
}

?>

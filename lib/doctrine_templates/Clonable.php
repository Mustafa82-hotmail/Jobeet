<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListenableTemplate
 *
 * @author mustafa
 */
class Clonable extends Doctrine_Template{
    //put your code here
    protected $_options = array(
    'relations' => array()
  );
  
    
   public function __construct(array $options = array()) {
      $this->_options=$options;
  }  
    
    
    
  public function setTableDefinition()
  {
      $this->addListener(new CloneListner($this->_options));
  }

}

?>

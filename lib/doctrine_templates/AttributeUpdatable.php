<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Updatable
 *
 * @author mustafa
 */
class AttributeUpdatable extends Doctrine_Template{
    
  protected $_options = array();
  public function setUp() {
      $invoker=$this->getInvoker();
      if(!isset($this->_options['referenceModel']))
      {
          throw new LogicException(sprintf("Reference model is not defined for the AttributeUpdatable behavior in model %s",  get_class($invoker)));
      }
      
      if(!isset($this->_options['locateMapping']))
      {
          throw new LogicException(sprintf("Locate mapping is not defined for the AttributeUpdatable behavior in model %s",  get_class($invoker)));
      }
      
      if(!isset($this->_options['onDelete']))
      {
          $this->_options['onDelete']="SET NULL";
      }
      $referenceTable=Doctrine_Core::getTable($this->_options['referenceModel']);
      $localTable=$invoker->getTable();
      foreach($this->_options['locateMapping'] as $key => $values)
      {
          if(!isset($values['referenceLocateAttribute']))
          {
              throw new LogicException(sprintf("referenceLocateAttribute is missing from the mapping %s in the AttributeUpdatable behavior of model %s",
                      $key,get_class($invoker)));
          }
          if(!isset($values['localLocateValue']) && !isset($values['localLocateAttribute']))
          {
              throw new LogicException(sprintf("Mapping %s requires either a localLocateValue or localLocateAttribute  in AttributeUpdatable behavior of modelis ",
                      $key,get_class($invoker)));
          }
          
          
          if(!$referenceTable->hasColumn($values['referenceLocateAttribute']))
          {
              throw new LogicException(sprintf("%s has no attribute with name %s in AttributeUpdatable behavior of model %s in locateMapping in mapping %s",
                      $this->_options['referenceModel'],$values['referenceLocateAttribute'],get_class($invoker),$key));
          }
          
          if(isset($values['localLocateAttribute'])&& !$localTable->hasColumn($values['localLocateAttribute']))
          {
              throw new LogicException(sprintf("%s has no attribute with name %s in AttributeUpdatable behavior of model %s in locateMapping in mapping %s",
                      get_class($invoker),$values['localLocateAttribute'],get_class($invoker),$key));
          }
      }
      
      if(isset($this->_options['updateMapping']))
      {
          foreach($this->_options['updateMapping'] as $key=>$values)
          {
              if(!isset($values['localAttribute']))
              {
                  throw new LogicException(sprintf("Missing localAttribute in the updateMapping in the AttributeUpdatable behavior of model %s",  get_class($invoker)));
              }
              
              if(!isset($values['referenceAttribute']))
              {
                  throw new LogicException(sprintf("Missing referenceAttribute in the updateMapping in the AttributeUpdatable behavior of model %s",  get_class($invoker)));
              }
              
              if(!$referenceTable->hasColumn($values['referenceAttribute']))
              {
                  throw new LogicException(sprintf("%s does not have %s attribute in the updateMapping in the AttributeUpdatable behavior of model %s",
                          $this->_options['referenceModel'],$values['referenceAttribute'],get_class($invoker)));
              }
              if(!$localTable->hasColumn($values['localAttribute']))
              {
                  throw new LogicException(sprintf("%s does not have %s attribute in the updateMapping in the AttributeUpdatable behavior of model %s",
                          get_class($invoker),$values['referenceAttribute'],get_class($invoker)));
              }
              $referenceType=$referenceTable->getColumnDefinition($values['referenceAttribute']);
              $localType=$localTable->getColumnDefinition($values['localAttribute']);
              if($referenceType['type']!=$localType['type'])
              {
                  throw new LogicException(sprintf("%s in model %s should have the same type as %s in model %s in the updateMapping in the AttributeUpdatable behavior of model %s",
                          $values['referenceAttribute'],$this->_options['referenceModel'],$values['localAttribute'],get_class($invoker),get_class($invoker)));
              }
              
          }
              
      }
      
      $this->addListener(new AttributeUpdatableListner($this->_options));
      
      parent::setUp();
  }
}

?>

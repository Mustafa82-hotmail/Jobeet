<?php

/**
 * This behavior will be used if we want to link two models and make them attributeDependent either from update point of view or delete point of view.\
 * Schema attributes:
 * referencesModels
 *   ModelName
      onDelete: could be either (SET NULL, or CASCADE) 
      locateMapping: 
        locateMapping1: {referenceLocateAttribute: attribute1, localLocateAttribute: attribute2}
        locateMapping2: {referenceLocateAttribute: attribute3, localLocateValue: <?php echo $value;?>}
      updateMapping:
        mapping1: {localAttribute: attribute1, referenceAttribute: attribute2, localValues: [0,1,2], referenceValues: [2,1,0]}
 * 
 * 
 * Description:
 *  1- ModelName (mandatory): the name of the model we want to reference.
 *  2- onDelete: what we want to do on deleting current object. default is SET NULL.
 *  3- locateMapping (mandatory): Those attributes will be used to locate a reference object from the current object.
 * each mapping will ahve a referenceLocateAttribute which is the name of the column in the reference model, and either local attribute of the current
 * model or a static value.
 * 4- updateMapping (optional):  
 *  if we want to do anything if an attribute of the current model is changed then here where we define the mapping. 
 * 
 * 
 * Example:
 * Thread:
  actAs:
    AttributeUpdatable:
      referencesModels:
        AnotherThread:
          onDelete: SET NULL
          locateMapping:
            locateMapping1: {referenceLocateAttribute: referenceId, localLocateAttribute: id}
            locateMapping2: {referenceLocateAttribute: referenceType, localLocateValue: <?php echo Thread::THREAD_TYPE;?>}
          updateMapping:
            mapping1: {localAttribute: state, referenceAttribute: status, localValues: [0,1,2], referenceValues: [0,1,0]}
        AnotherThread1:
          onDelete: CASCADE
          locateMapping:
            locateMapping1: {referenceLocateAttribute: referenceId, localLocateAttribute: id}
            locateMapping2: {referenceLocateAttribute: referenceType, localLocateValue: <?php echo Thread::THREAD_TYPE;?>}
          updateMapping:
            mapping1: {localAttribute: state, referenceAttribute: status, localValues: [0,1,2], referenceValues: [2,1,0]}
      
  columns:
    title:
      type: string(255)
      notnull: true
    state:
      type: string(255)
      notnull: false
    posts_status_number:
      type: array
 * 
 * 
 * 
 * AnotherThread:
  columns:
    title:
      type: string(255)
      notnull: true 
    status:
      type: string(255)
      notnull: false
    referenceId:
      type: integer
    referenceType:
      type: string(255)
      
      
AnotherThread1:
  columns:
    title:
      type: string(255)
      notnull: true 
    status:
      type: string(255)
      notnull: false
    referenceId:
      type: integer
    referenceType:
      type: string(255)    
 */
class AttributeUpdatable extends Doctrine_Template{
    
  protected $_options = array();
  public function setUp() {
      $invoker=$this->getInvoker();
      if(!isset($this->_options['referencesModels']))
      {
          throw new LogicException(sprintf("referencesModels is not defined for the AttributeUpdatable behavior in model %s",  get_class($invoker)));
      }
      
      
      foreach($this->_options['referencesModels'] as $key=>$options)
      {
          
          $referenceTable=Doctrine_Core::getTable($key);
          if(!isset($options['locateMapping']))
          {
              throw new LogicException(sprintf("Locate mapping is not defined for the AttributeUpdatable behavior in model %s",  get_class($invoker)));
          }
          
          if(!isset($options['onDelete']))
          {
              $this->_options[$key]['onDelete']="SET NULL";
          }
          
         // $referenceTable=Doctrine_Core::getTable($options['referenceModel']);
          $localTable=$invoker->getTable();
          
          foreach($options['locateMapping'] as $key => $values)
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
                            $key,$values['referenceLocateAttribute'],get_class($invoker),$key));
                }

                if(isset($values['localLocateAttribute'])&& !$localTable->hasColumn($values['localLocateAttribute']))
                {
                    throw new LogicException(sprintf("%s has no attribute with name %s in AttributeUpdatable behavior of model %s in locateMapping in mapping %s",
                            get_class($invoker),$values['localLocateAttribute'],get_class($invoker),$key));
                }
            }
            
            
          if(isset($options['updateMapping']))
            {
                foreach($options['updateMapping'] as $key=>$values)
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
                                $key,$values['referenceAttribute'],get_class($invoker)));
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
                                $values['referenceAttribute'],$key,$values['localAttribute'],get_class($invoker),get_class($invoker)));
                    }

                }
              
            }
              
      }
      
      
      
      
      
      
      
      
      
      
      
      
      $this->addListener(new AttributeUpdatableListner($this->_options));
      
      parent::setUp();
  }
}

?>

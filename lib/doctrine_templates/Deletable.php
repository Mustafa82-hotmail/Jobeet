<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Deletable
 *
 * @author mustafa
 */
class Deletable extends Doctrine_Template{
  protected $_options = array(
    'relations' => array()
  );
 
  public function setTableDefinition()
  {
      
      
    foreach ($this->_options['references'] as $reference => $options)  
    {
        if(!isset($option['referenceClass']))
        {
            throw LogicException();
        }
        
        if(!isset($options['referenceTypeColumn']))
        {
            $this->_options['references'][$reference]['referenceTypeColumn']=Doctrine_Inflector::tableize("ReferenceObjectType");
        }
        if(!isset($options['referenceIdColumn']))
        {
            $this->_options['references'][$reference]['referenceIdColumn']=Doctrine_Inflector::tableize("ReferenceObjectId");
        }
        if(!isset($options['ownReferenceType']))
        {
            $this->_options['references'][$reference]['ownReferenceType']=$this->getTable()->getOption('name');
        }
        
        $referenceTypeColumn=$this->_options['references'][$reference]['referenceTypeColumn'];
        $referenceIdColumn=$this->_options['references'][$reference]['referenceIdColumn'];
        $ownReferenceType=$this->_options['references'][$reference]['ownReferenceType'];
        
        $referenceClass=$option['referenceClass'];
        $table=Doctrine::getTable($referenceClass);
        if(!$table->hasColumn($referenceTypeColumn))
        {
            $table->setColumn($referenceTypeColumn, 'varchar', null, array('default' => ''));
        }
        if(!$table->hasColumn($referenceIdColumn))
        {
            $table->setColumn($referenceIdColumn, 'integer', null, array('default' => 0));
        }
        if(!$table->hasColumn($referenceTypeColumn))
        {
            $table->setColumn($referenceTypeColumn, 'varchar', null, array('default' => ''));
        }
        
        
    }
    foreach ($this->_options['relations'] as $relation => $options)
    {
        //echo $this->getTable()->getTableName();
      // Build column name if one is not given
      if (!isset($options['columnName']))
      {
        $this->_options['relations'][$relation]['columnName'] = 'num_'.Doctrine_Inflector::tableize($this->getTable()->getOption('name'));
      }
      
      // Add the column to the related model
      $columnName = $this->_options['relations'][$relation]['columnName'];
      $relatedTable = $this->_table->getRelation($relation)->getTable();
      $this->_options['relations'][$relation]['className'] = $relatedTable->getOption('name');
      $relatedTable->setColumn($columnName, 'integer', null, array('default' => 0));
    }
    $this->addListener(new CountCacheListener($this->_options));

  }
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountCache
 *
 * @author mustafa
 */
class CountCache extends Doctrine_Template
{
  protected $_options = array(
    'relations' => array()
  );
 
  public function setTableDefinition()
  {
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
      $testable0 = new Testable(array(
             'scoreColumn' => 'score',
             'className' => 'Post',
             'clonedFields' => 
             array(
              0 => 'body',
              1 => 'title',
             ),
             ));
       
      $relatedTable->addTemplate("Testable", $testable0);
    }
    $this->addListener(new CountCacheListener($this->_options));

  }
}
?>

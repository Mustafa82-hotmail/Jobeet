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
      
        
      if($this->getInvoker()->getTable()->hasRelation($relation))  
      {
          
          if(!isset($options['cache_type']))  
            {
                $this->_options['relations'][$relation]['cache_type']="normal";
            }

            if($this->_options['relations'][$relation]['cache_type']=="normal")
            {
                
                if (!isset($options['columnName']))
                {
                  $this->_options['relations'][$relation]['columnName'] = Doctrine_Inflector::tableize($this->getTable()->getOption('name'))."s_number";

                }

                $columnName = $this->_options['relations'][$relation]['columnName'];
                $relatedTable = $this->_table->getRelation($relation)->getTable();
                $this->_options['relations'][$relation]['className'] = $relatedTable->getOption('name');
                
                
                if(!$relatedTable->hasColumn($columnName))
                {
                    throw new LogicException(Doctrine_Inflector::tableize($this->getTable()->getOption('name'))." should have a column of name $columnName and type Integer
                            for the CountCache behavior of type normal");
                }
                 if($type['type']!="integer")
                {
                    print_r($type);die();
                    throw new LogicException(Doctrine_Inflector::tableize($this->getTable()->getOption('name'))." should have a column of name $columnName and type Array
                            for the CountCache behavior of type normal");
                }
                

            }
            elseif($this->_options['relations'][$relation]['cache_type']=="cacheids")
            {
                if (!isset($options['columnName']))
                {
                  $this->_options['relations'][$relation]['columnName'] = Doctrine_Inflector::tableize($this->getTable()->getOption('name'))."s_ids";

                }

                $columnName = $this->_options['relations'][$relation]['columnName'];
                $relatedTable = $this->_table->getRelation($relation)->getTable();
                $this->_options['relations'][$relation]['className'] = $relatedTable->getOption('name'); 
                if(!$relatedTable->hasColumn($columnName))
                {
                    throw new LogicException(Doctrine_Inflector::tableize($this->getTable()->getOption('name'))." should have a column of name $columnName and type Array
                            for the CountCache behavior of type cacheids");
                }
                $type=$relatedTable->getColumnDefinition($columnName);
                if($type['type']!="array")
                {
                    print_r($type);die();
                    throw new LogicException(Doctrine_Inflector::tableize($this->getTable()->getOption('name'))." should have a column of name $columnName and type Array
                            for the CountCache behavior of type cacheids");
                }
                
                
            }
            elseif($this->_options['relations'][$relation]['cache_type']=="attributecache")
            {
                
                if (!isset($options['columnName']))
                {
                  $this->_options['relations'][$relation]['columnName'] = Doctrine_Inflector::tableize($this->getTable()->getOption('name'))."s_status_number";

                }
                if(!isset($options['targetAttribute']))
                {
                    throw new LogicException("targetAttribute is missing and it's mandatory for countCache behavior of type  attributecache");
                }
                if(!isset($options['attributeValues']))
                {
                    throw new LogicException("attributeValues is missing and it's mandatory for countCache behavior of type  attributecache");
                }
                
                
                $values=array();
                if(is_array($options['attributeValues']))
                {
                    foreach($options['attributeValues'] as $value)
                    {
                        $values[$value]=array();
                    }
                    
                }else
                {
                    $values[$options['attributeValues']]=array();
                }
                
                
                $columnName = $this->_options['relations'][$relation]['columnName'];
                $relatedTable = $this->_table->getRelation($relation)->getTable();
                $this->_options['relations'][$relation]['className'] = $relatedTable->getOption('name');
                if(!$relatedTable->hasColumn($columnName))
                {
                    throw new LogicException(Doctrine_Inflector::tableize($this->getTable()->getOption('name'))." should have a column of name $columnName and type Array
                            for the CountCache behavior of type attributecache");
                }
                $type=$relatedTable->getColumnDefinition($columnName);
                if($type['type']!="array")
                {
                    print_r($type);die();
                    throw new LogicException(Doctrine_Inflector::tableize($this->getTable()->getOption('name'))." should have a column of name $columnName and type Array
                            for the CountCache behavior of type attributecache");
                }
                
            }
            else{
                throw new LogicException($this->_options['relations'][$relation]['cache_type']." is not recognized as a valid type for the Cachable behaviour!");
            }
      }else{
          throw new LogicException($this->_options['relations'][$relation]['cache_type']." is not recognized as a relation for the table !".$this->getInvoker()->getTable()->getOption('name'));
      }
        
        
      
        
      
      
    }
    $this->addListener(new CountCacheListener($this->_options));
  }
}
?>

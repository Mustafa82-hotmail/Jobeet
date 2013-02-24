<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AutoCompletable
 *
 * @author mustafa
 */
class AutoCompletable extends Doctrine_Template{
    
  protected $_options = array(
    'relations' => array()
  );
 
  public function setTableDefinition()
  {
      
      foreach ($this->_options['relations'] as $relation=> $options)
      {
          $relatedTable=$this->_table->getRelation($relation)->getTable();
          $this->_options['relations'][$relation]['className'] = $relatedTable->getOption('name');
          if(!isset($relation['defaultScore']))
          {
              $this->_options['relations'][$relation]['defaultScore']=1;
          }
          if(!isset($relation['defaultNullScore']))
          {
              $this->_options['relations'][$relation]['defaultNullScore']=50;
          }
          
          
          $this->addListener(new CloneListner(array()), "Post");
      }
      
      
      //echo get_class($this);die();
      //$this->addListener(new AutoCompletableListner($this->_options));
      //$relatedTable->addListener(new AutoCompletableListner($this->_options));
      //$this->actAs($options);
      
  }
  
  public function addNew($args)
  {
      
  }
}

?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mus_AutoCompletable
 *
 * @author mustafa
 */
class Mus_AutoCompletable extends Doctrine_Template{
    
  protected $_options = array();
 
  public function setTableDefinition()
  {
      if(isset($this->_options['relation']))
      {
          foreach ($this->_options['relation'] as $relation => $options)
            {
                if(!isset($relation['defaultScore']))
                {
                    $this->_options['relation'][$relation]['defaultScore']=50;
                }
            }
      }
      
      $this->hasColumn("name", "string", 255);
      $this->hasColumn("score", "integer");
      $this->actAs("Timestampable");
      $this->addListener(new AutoCompleteSourceListener($this->_options));
  }
}

?>

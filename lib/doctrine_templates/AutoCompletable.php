<?php

/**
 * Description of AutoCompletable: Any entity that implement the autocompletable behavior will have two columns name and score and it'll expect the defaultScore
 * in case the record has a reference value to an autocompletable entity.
 * The autoCompletable behaviour works like this:
 * 1- The autocompletable entity has a relation to an AutocompleteSource entity:
 *  a. in case of inserting a new record : then if a record in the current entity with the same foreign key and the same value for the name
 * exists then we simply increase the score by one and don't insert a new record. otherwise we insert a new record with defualt score.
 *  c. in case of deleting a record: then it'll check for an existing record with the same name and foreign value equal to null in table
 * in case it found it'll add to it's score the difference between with the score of the current record and the defualt one and delete the current record, otherwise
 * it'll simply decrease the score of the current record.
 * 2- The autocompletable entity has no relation to an AutocompleteSource entity:
 *  a. in case of inserting a new record: we check if the name already exists we simply increase the score, otherwise we add it with a score equals ot 1.
 *  b. in case of delete or update it'll happen normally.
    
 *
 * @author mustafa
 */
class AutoCompletable extends Doctrine_Template{
    
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

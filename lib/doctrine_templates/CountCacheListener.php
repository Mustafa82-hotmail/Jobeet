<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CountCacheListener
 *
 * @author mustafa
 */
class CountCacheListener extends Doctrine_Record_Listener
{
  protected $_options;
 
  public function __construct(array $options)
  {
    $this->_options = $options;
  }
  public function postInsert(Doctrine_Event $event)
  {
    $invoker = $event->getInvoker();
    foreach ($this->_options['relations'] as $relation => $options)
    {
      $table = Doctrine::getTable($options['className']);
      
      $relation = $table->getRelation($options['foreignAlias']);
      
      
      //var_dump((string)$relation);die();
     
     // echo ($invoker->$relation['foreign']);die();
      $table
        ->createQuery()
        ->update()
        ->set($options['columnName'], $options['columnName'].' + 1')
        ->where($relation['local'].' = ?', $invoker->$relation['foreign'])
        ->execute();
    }
  }
  
  public function postDelete(Doctrine_Event $event) {
      $invoker=$event->getInvoker();
      foreach ($this->_options['relations'] as $relation => $options)
      {
          $table=Doctrine::getTable($options['className']);
          $relation=$table->getRelation($options['foreignAlias']);
          $table->createQuery()
                  ->update()
                  ->set($options['columnName'], $options['columnName'].' - 1')
                  ->where($relation['local'].' = ?', $invoker->$relation['foreign'])
                  ->execute();
      }
      parent::postDelete($event);
  }
  
}

?>

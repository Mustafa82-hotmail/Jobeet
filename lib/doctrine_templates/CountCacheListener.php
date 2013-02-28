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
   public function postInsert(Doctrine_Event $event) {
       $invoker=$event->getInvoker();
       foreach ($this->_options['relations'] as $relation => $options)
        {
          if(isset($options['cache_type']))
          {
              if($options['cache_type']=="normal")
              {
                    $table = Doctrine::getTable($options['className']);
                    $relation = $table->getRelation($options['foreignAlias']);
                    $parent=$table->find($invoker->$relation['foreign']);
                    if(!is_null($parent))
                    {
                        if(is_null($parent->get($options['columnName'])))
                        {
                            $parent->set($options['columnName'],1);
                        }else{
                            $parent->set($options['columnName'],$parent->get($options['columnName'])+1);
                        }
                        $parent->save();
                    }
                    
                    
                    
              }
              elseif($options['cache_type']=="cacheids")
              {
                  $table = Doctrine::getTable($options['className']);
                  $relation = $table->getRelation($options['foreignAlias']);
                  $record=$table->findById($invoker->$relation['foreign'])->getFirst();





                  if(!is_null($record))
                  {

                      $ids=$record->get($options['columnName']);
                      $ids[]=$invoker->getId();
                      $record->set($options['columnName'],$ids);
                      $record->save();
                  }else
                  {
                      trigger_error(" No ".$options['className']." found for ".get_class($invoker)." with id=".$invoker->getId());
                  }

              }
              elseif($options['cache_type']=="attributecache")
              {
                  $table = Doctrine_Core::getTable($options['className']);
                  $relation = $table->getRelation($options['foreignAlias']);
                  $record=$table->findById($invoker->$relation['foreign'])->getFirst();
                  $cat=$invoker->get($options['targetAttribute']);
                  if(!is_null($record))
                  {    
                      $ids=$record->get($options['columnName']);
                      if(!is_null($ids))
                      {
                          if(!is_null($cat))
                            {
                              $ids[$cat][]=$invoker->getId();

                            }
                      }
                      else
                      {
                          $ids[$cat]=array($invoker->getId());
                      }

                      $record->set($options['columnName'],$ids);
                      $record->save();

                  }else
                  {
                      trigger_error(" No ".$options['className']." found for ".get_class($invoker)." with id=".$invoker->getId());
                  }
              }
              else{
                  trigger_error($options['cache_type']." is an invalid cache type to be passed to the CacheListner");
              }
          }else{
              trigger_error("No cache type is passed to the CacheListner");
          }
      }
      
        parent::postInsert($event);
   }
   
   
   
   public function preSave(Doctrine_Event $event) {
      
      $invoker=$event->getInvoker();
      if(!$invoker->isNew())
      {
          $modifiedFields=$invoker->getModified();
          foreach ($this->_options['relations'] as $relation => $options)
          {    
              
              if($options['cache_type']=="attributecache")
              {
                  $table = Doctrine_Core::getTable($options['className']);
                  $relation = $table->getRelation($options['foreignAlias']);
                  $cat=$invoker->get($options['targetAttribute']);
                  if(array_key_exists($relation['foreign'],$modifiedFields))
                  {
                      $oldInvoker=$invoker->getTable()->find($invoker->getId());
                      if(!is_null($oldInvoker))
                      {
                          $record=$table->findById($oldInvoker->$relation['foreign'])->getFirst();
                          if(!is_null($record))
                          {
                              $ids=$record->get($options['columnName']);
                              if(!is_null($ids))
                              {
                                  foreach($ids as $key => $value)
                                  {
                                      $pos=array_search($oldInvoker->getId(), $value);
                                      if($pos!== FALSE)
                                      {
                                          unset($ids[$key][$pos]);
                                          break;
                                          
                                      }
                                   }
                                   $record->set($options['columnName'],$ids);
                                   $record->save();

                              }
                          }
                       }
                       
                       foreach($modifiedFields as $key => $value)
                       {
                           $invoker->set($key,$value);
                       }
                       
                       if(!is_null($cat))
                       {
                           $record=$table->findById($invoker->$relation['foreign'])->getFirst();
                           if(!is_null($record))
                           {
                               $ids=$record->get($options['columnName']);
                               if(!is_null($ids))
                               {
                                   $ids[$cat][]=$invoker->getId();
                               }
                               else
                               {
                                   $ids[$cat]=array($invoker->getId());
                               }
                               $record->set($options['columnName'],$ids);
                               $record->save();
                            }


                        }


                    }
                    elseif(array_key_exists($options['targetAttribute'], $modifiedFields))
                    {
                        $record=$table->findById($invoker->$relation['foreign'])->getFirst();
                        if(!is_null($record))
                        {
                            $ids=$record->get($options['columnName']);
                            if(!is_null($ids))
                            {
                                foreach($ids as $key => $value)
                                {
                                    $pos=array_search($invoker->getId(), $value);
                                    if($pos!== FALSE)
                                    {
                                        unset($ids[$key][$pos]);
                                        break;
                                    }
                                }

                            }
                            if(!is_null($cat))
                            {
                                $ids[$cat]=array($invoker->getId());
                            }
                            $record->set($options['columnName'],$ids);
                            $record->save();
                            
                        }
                        else
                        {
                            trigger_error(" No ".$options['className']." found for ".get_class($invoker)." with id=".$invoker->getId());
                        }

                    }
                }
                elseif($options['cache_type']=="cacheids")
                {
                    $table = Doctrine_Core::getTable($options['className']);
                    $relation = $table->getRelation($options['foreignAlias']);
                    $cat=$invoker->get($options['targetAttribute']);

                     if(array_key_exists($relation['foreign'],$modifiedFields))
                      {
                         
                          $oldInvoker=$invoker->getTable()->find($invoker->getId());
                          if(!is_null($oldInvoker))
                          {
                              $record=$table->findById($oldInvoker->$relation['foreign'])->getFirst();
                              if(!is_null($record))
                              {
                                  $ids=$record->get($options['columnName']);
                                  $keys=array_search($oldInvoker->getId(), $ids);
                                  if($keys!==FALSE)
                                  {
                                      unset($ids[$keys]);
                                  }


                                  $record->set($options['columnName'],$ids);
                                  $record->save();
                              }
                          }
                          
                          
                          foreach($modifiedFields as $key => $value)
                            {
                                $invoker->set($key,$value);
                            }

                            if(!is_null($cat))
                            {
                                $record=$table->findById($invoker->$relation['foreign'])->getFirst();
                                if(!is_null($record))
                                {
                                    $ids=$record->get($options['columnName']);
                                    $ids[]=$invoker->getId();
                                    $record->set($options['columnName'],$ids);
                                    $record->save();
                                }else
                                {
                                    trigger_error(" No ".$options['className']." found for ".get_class($invoker)." with id=".$invoker->getId());
                                }
                            }
                          
                          
                          
                          
                      }
                }
              
              
              
              
          }
          
          
      }
      
      parent::preSave($event);
  }
  
  public function postDelete(Doctrine_Event $event) {
    
      $invoker=$event->getInvoker();

      foreach ($this->_options['relations'] as $relation => $options)
      {
            if(isset($options['cache_type']))
            {
                if($options['cache_type']=="normal")
                {
                    $table=Doctrine::getTable($options['className']);
                    $relation=$table->getRelation($options['foreignAlias']);
                    $table->createQuery()
                    ->update()
                    ->set($options['columnName'], $options['columnName'].' - 1')
                    ->where($relation['local'].' = ?', $invoker->$relation['foreign'])
                    ->execute();
                }
                elseif($options['cache_type']=="cacheids")
                {
                    $table = Doctrine::getTable($options['className']);
                    $relation = $table->getRelation($options['foreignAlias']);
                    $record=$table->findById($invoker->$relation['foreign'])->getFirst();
                    if(!is_null($record))
                    {

                        $ids=$record->get($options['columnName']);
                        $keys=array_search($invoker->getId(), $ids);
                        if($keys!==FALSE)
                        {
                            unset($ids[$keys]);
                        }
                        

                        $record->set($options['columnName'],$ids);
                        $record->save();
                    }else
                    {
                        trigger_error(" No ".$options['className']." found for ".get_class($invoker)." with id=".$invoker->getId());
                    }
                }
                elseif($options['cache_type']=="attributecache")
                {
                    $table = Doctrine_Core::getTable($options['className']);
                    $relation = $table->getRelation($options['foreignAlias']);
                    $record=$table->findById($invoker->$relation['foreign'])->getFirst();
                    $cat=$invoker->get($options['targetAttribute']);
                    if(!is_null($record))
                    {    
                        $ids=$record->get($options['columnName']);
                        if(!is_null($ids))
                        {
                            if(!is_null($cat))
                              {
                                  if(isset($ids[$cat]))
                                  {
                                      
                                      $keys=array_search($invoker->getId(), $ids[$cat]);
                                      if($keys!==FALSE)
                                      {
                                          unset($ids[$cat][$keys]);
                                      }

                                  }
                              }
                        }
                        $record->set($options['columnName'],$ids);
                        $record->save();

                    }else
                    {
                        trigger_error(" No ".$options['className']." found for ".get_class($invoker)." with id=".$invoker->getId());
                    }
                }
                else
                {
                    trigger_error($relation['cache_type']." is an invalid cache type to be passed to the CacheListner");
                }
            }else{
                trigger_error("No cache type is passed to the CacheListner");
            }

      }
      parent::postDelete($event);
  }
  
  
  
  
 
  
  
}

?>

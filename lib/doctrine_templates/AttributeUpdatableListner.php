<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AttributeUpdatableListner
 *
 * @author mustafa
 */
class AttributeUpdatableListner extends Doctrine_Record_Listener
{
  protected $_options;
 
  public function __construct(array $options)
  {
    $this->_options = $options;
  }
  
  
  
  
  public function preSave(Doctrine_Event $event) {
      $invoker=$event->getInvoker();
      
      if(!$invoker->isNew())
      {
          $array=$invoker->getModified();
          
          foreach($this->_options['referencesModels'] as $model => $options)
          {
              if(isset($options['updateMapping']))
              {
                $localUpdateAttributes=array();
                foreach($options['updateMapping'] as $key => $values)
                {
                    $localUpdateAttributes[$values['localAttribute']]=true;
                }
                $common= array_intersect_key($localUpdateAttributes,$invoker->getModified());
                if(is_array($common) && count($common)>0)
                {
                    $referenceTable=  Doctrine_Core::getTable($model);
                    $query=$referenceTable->createQuery()->select();
                    foreach($options['locateMapping'] as $key => $values)
                    {
                      if(isset($values['localLocateAttribute']))
                        {
                            $query->andWhere($values['referenceLocateAttribute'].' = '. $invoker->get($values['localLocateAttribute']));
                        }else{
                            $query->andWhere($values['referenceLocateAttribute'].' = '. $values['localLocateValue']);
                        }
                    }

                }

                $results=$query->execute();
                if(count($results)>0)
                {
                    foreach($results as $obj)
                    {
                        foreach($options['updateMapping'] as $key => $values)
                        {
                            if(isset($values['localValues']) && isset($values['referenceValues']))
                            {
                                $index=  array_search($invoker->get($values['localAttribute']), $values['localValues']);
                                if($index===false || !isset($values['referenceValues'][$index]))
                                {
                                    $obj->set($values['referenceAttribute'],$invoker->get($values['localAttribute']));
                                }else{
                                    $obj->set($values['referenceAttribute'],$values['referenceValues'][$index]);
                                }

                            }else{
                                $obj->set($values['referenceAttribute'],$invoker->get($values['localAttribute']));
                            }
                        }
                        $obj->save();

                    }
                }
              }
              
          }
      }
      parent::preSave($event);
  }
  
  
  public function preDelete(Doctrine_Event $event) {
      $invoker=$event->getInvoker();
      
      foreach($this->_options['referencesModels'] as $model => $options)
      {
          if(isset($options['onDelete']))
          {
              $referenceTable=  Doctrine_Core::getTable($model);
              $query=$referenceTable->createQuery()->select();
              foreach($options['locateMapping'] as $key => $values)
              {
                if(isset($values['localLocateAttribute']))
                  {
                      $query->andWhere($values['referenceLocateAttribute'].' = '. $invoker->get($values['localLocateAttribute']));
                  }else{
                      $query->andWhere($values['referenceLocateAttribute'].' = '. $values['localLocateValue']);
                  }
              }
              $results=$query->execute();
              if(count($results)>0)
              {
                if(strtoupper($options['onDelete'])=="CASCADE")
                {
                    foreach($results as $record)
                    {
                        $record->delete();
                    }
                }else{
                    foreach($results as $record)
                    {
                        foreach($options['locateMapping'] as $key => $values)
                        {
                            $record->set($values['referenceLocateAttribute'],null);
                            $record->save();
                        }
                    }
                }
                
              }
          }
      }
  }
}

?>

<?php

/**
 * test actions.
 *
 * @package    jobeet
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      //$thread=new Thread();
      //$thread->actAs("Sluggable");
      /*$q= $thread->getTable()->createQuery('c')
                        ->where("title = ?",'thread 1')
                        ->andWhere("num_post =?",1);
      $results=$q->execute();*/
      //print_r($results);die();
      
      
    $thread=new Thread();
     $thread->setTitle("thread 1");
     $thread->save();
    $post = new Post();
    $post->thread_id = 1;
    $post->body = 'body sadfsa of the post';
    
    $post->setTitle("hi");
    $post->save();
    //$table=Doctrine::getTable("Thread");
    
    /*$relation=$table->getRelation("Posts");
    echo $relation['foreign'];
    if(is_null($post->$relation['foreign']))
    {
        echo "False";
    }else
    {
        echo "True";
    }
    
    if($post->hasReference("Thread")){
        echo "true";die();
    }else{
        echo "False";die();
    }*/
//    $post->save();
    //$post->delete();
  }
}

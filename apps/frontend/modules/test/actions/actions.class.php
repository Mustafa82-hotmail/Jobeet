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
      //$post=Doctrine_Core::getTable("Post")->findBy($fieldName, $value)
      //$relation=Doctrine_Core::getTable("Post")->getRelation("Thread");
      //$post=new Post();
      //echo $post->getPostAutoComplete();
      //echo Doctrine_Core::getTable("Post")->getRelation("Thread");die();
          //$post=$results->getFirst();
          //$post->setName("Hello");
          //$post->save();
 //     $record=$post->getPostAutoComplete();
      //
      echo "hiiiiiiiiii";
      die();
      
      /*$thread=new Thread();
      
     $thread->setTitle("thread 1");
     $thread->save();
     $post=new Post();
     $post->setName("hi");
     $post->setThread($thread);
     $post->setBody("Hiiiiiiiiiiiii");
     $post->save();
    /*  $r=new RandomAutoComplete();
      $r->setName('hi');
      $r->save();
      
    /*  $p=new PostAutoComplete();
      $p->setName("hi");
      $p->setPostId(1);
      $p->save();
      
     /* $thread=new Thread();
     $thread->setTitle("thread 1");
     $thread->save();
     $post=new Post();
     $post->setName("hi");
     $post->setThread($thread);
     $post->setBody("Hiiiiiiiiiiiii");
     $post->save();
     /* $post=new Post();
      $post->setAttribute($attr, $value);
      if($post instanceof Doctrine_Record)
      {
          echo "true";
      }
      $relation=$post->getTable()->getRelation("Thread");
      $columnName=$relation['local'];
      if($post->hasRelation($columnName))
      {
          echo "true";
      }
      if(is_null($post->get($columnName)))
      {
          echo "true";
      }
      echo $relation;
      die();
      
      
      
      //$thread=new Thread();
      //$thread->actAs("Sluggable");
      /*$q= $thread->getTable()->createQuery('c')
                        ->where("title = ?",'thread 1')
                        ->andWhere("num_post =?",1);
      $results=$q->execute();*/
      //print_r($results);die();
      
   /*$pc=new PostClone();
      
    $thread=new Thread();
     $thread->setTitle("thread 1");
     $thread->save();
    
    
    $post = new Post();
//  /  $post->hasColumn($name);
//    $post->actAs("Timestampable");
    
    
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

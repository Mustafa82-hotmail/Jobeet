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
	/* This is form Hotmail contributer*/
/*      $thread=Doctrine_Core::getTable("Thread")->find(1);
      
      $thread->delete();
//      $thread->delete();
      /*$thread=Doctrine_Core::getTable("Thread")->find(1);
      $thread->delete();
      /*$thread=Doctrine_Core::getTable("Thread")->find(3);
      
      $thread->setState(10);
      $thread->save();
      /*$anotherThread=new AnotherThread();
      $anotherThread->setTitle("AnotherThread");
      $anotherThread->setStatus(0);
      $anotherThread->setReferenceId(4);
      $anotherThread->setReferenceType(Thread::THREAD_TYPE);
      $anotherThread->save();
      
   /*$thread=Doctrine_Core::getTable("Thread")->find(1);
   $thread->delete();
/*      $thread->setState(1);
      $array=$thread->getModified();
      $thread->save();
      $array=$thread->getModified();
      /*$thread=Doctrine_Core::getTable("Thread")->find(1);
      $thread->setState(1);
      $thread->save();
      /*$anotherThread=new AnotherThread();
      $anotherThread->setTitle("AnotherThread");
      $anotherThread->setStatus(0);
      $anotherThread->setReferenceId(1);
      $anotherThread->setReferenceType(Thread::THREAD_TYPE);
      $anotherThread->save();
/*      $thread=new Thread();
      $thread->setTitle("thread1");
      $thread->setState(0);
      $thread->save();
              
      //$post=  Doctrine_Core::getTable("Post")->find(1);
      //$post->setThreadId(2);
      //$post->delete();
      //$post->setPostType(1);
      //$post->save();
      
      
      /*$thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(0);
      $post->save();*/
 /* $thread = Doctrine::getTable("Thread")->find(1);
      foreach($thread->get("posts_status_number") as $key => $value)
      {
          echo $key."<br/>";
          foreach($value as $val)
          {
              echo $val."-";
          }
          echo "<br/>";
      }
      /*$thread = Doctrine::getTable("Thread")->find(1);
      foreach($thread->get("posts_status_number") as $key => $value)
      {
          echo $key."<br/>";
          foreach($value as $val)
          {
              echo $val."-";
          }
          echo "<br/>";
      }
      /*$thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(0);
      $post->save();*/
      //@todo bug on delte
      /*$post=Doctrine_Core::getTable("Post")->find(1);
      $post->setPostType(0);
      $post->save();
      
       $thread = Doctrine::getTable("Thread")->find(1);
      foreach($thread->get("posts_status_number") as $key => $value)
      {
          echo $key."<br/>";
          foreach($value as $val)
          {
              echo $val."-";
          }
          echo "<br/>";
      }
      
      
   /*   $post=Doctrine_Core::getTable("Post")->find(2);
      
      $post->delete();
      /*$pac=new PostAutoComplete();
      $pac->setName("hi");
      $pac->setPostId(2);
      $pac->save();
      
      /*$thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(0);
      $post->save();
      
      
   /*   $rac=new RandomAutoComplete();
      $rac->setName("hi");
      $rac->save();
          
/*
      $post=  Doctrine::getTable("Post")->find(2);
      $post->delete();
      
/*      $postAutoComplete=new PostAutoComplete();
      $postAutoComplete->setPostId(1);
      $postAutoComplete->setName("hi");
      $postAutoComplete->save();
      /*$thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(0);
      $post->save();
      
      
      
      
      
  /*    $thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(0);
      $post->save();
    */
     
      /*$post=new Post();
      $post=Doctrine_Core::getTable("Post")->find(1);
      
      $post->setName("hiiii2");
      $post->setName("hiiii3");
      $post->setName("hiiii4");
      
      
      $modified=$post->getModified(true);
      $mod=$post->getLastModified(true);
      $node=$post->getNode();
      echo $post;die();
      $thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId($thread);
      $post->setPostType(1);
      $post->save();
      
  
      
/*      $post=Doctrine_Core::getTable("Post")->find(1);
      $post->setPostType(2);
      $post->save();
      
      
      $thread = Doctrine::getTable("Thread")->find(1);
      foreach($thread->get("posts_status_number") as $key => $value)
      {
          echo $key."<br/>";
          foreach($value as $val)
          {
              echo $val."-";
          }
          echo "<br/>";
      }
      
      
      
      
      
      
      /*
      
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(2);
      $post->setPostType(0);
      $post->save();
   //   $post=new Post();
 /*     $post=Doctrine_Core::getTable("Post")->find(1);
      $post->setPostType(2);
      $post->setPostType(0);
      if($post->isModified())
      {
          echo "True";
      }
      $changed=$post->getModified(true);
      die();
/*      $post=new Post();
      $thread = Doctrine::getTable("Thread")->find(1);
      foreach($thread->get("posts_status_number") as $key => $value)
      {
          echo $key."<br/>";
          foreach($value as $val)
          {
              echo $val."-";
          }
      }
     /* $thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(0);
      $post->save();
      $thread = Doctrine::getTable("Thread")->find(1);
     
    
     echo $thread->get("posts_status_number");
/*      $thread=new Thread();
     $thread = Doctrine::getTable("Thread")->find(1);
     
    
     echo $thread->get("posts_status_number");
  
      /*$post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->setPostType(1);
      $post->save();
      
        

      
      
   /*   $thread=new Thread();
      $thread->setTitle("Hi");
      $thread->save();
      
      $thread=Doctrine_Core::getTable("Thread")->findById(1)->getFirst();
      echo $thread->getTitle();
      echo "<br/>";
      foreach($thread->get("posts_status_number") as $key=>$value)
      {
          echo $key."<br/>";
          foreach($value as $val)
          {
              echo $val."-";
              
          }
      }
              
      
      
      
      
/*
      $post=new Post();
      $post->setName("hi");
      $post->setPostType(1);
      $post->setThreadId(2);
      $post->save();
     // Doctrine_Core::getTable("Post")->findById(2)->delete();
      /*$post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->save();
     /* $thread=new Thread();
      $thread->setTitle("thread1");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThread($thread);
      $post->save();
      /*$post=  Doctrine_Core::getTable("Post")->findById(1);
      $post->delete();
      /*$post=new Post();
      $post->setName("hi");
      $post->setThreadId(1);
      $post->save();
     /* $thread=new Thread();
      $thread->setTitle("thread1");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThread($thread);
      $post->save();
      /*$post=Doctrine_Core::getTable("Post")->findOneById(3);
        $post->delete();
      /*$pa=new PostAutoComplete();
      $pa->setPostId(3);
      $pa->save();
//      $pa->save();
      /*$thread=new Thread();
      $thread->setTitle("thread1");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThread($thread);
      $post->save();
      
      
      
     /*   $post=Doctrine_Core::getTable("Post")->findOneById(2);
        $post->delete();
        
     
    //  $pa->setPostId(2);
//      $pa->save();
        //$pa->delete();
      //$post->delete();
      //$pa=new PostAutoComplete();
      //$pa->delete();
      //$pa=new PostAutoComplete();
      //$pa->setName("hi");
      //$pa->save();
     /* $thread=new Thread();
      $thread->setTitle("thread1");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThread($thread);
      $post->save();
      
/*      $thread=new Thread();
      $thread->setTitle("thread1");
      $thread->save();
      $post=new Post();
      $post->setName("hi");
      $post->setThread($thread);
      $post->save();
  */
     /* $post=Doctrine_Core::getTable("Post")->findOneById(3);
      $post->setName("hello");
      $post->delete();
      $post=new Post();
      //$post->getTable()->getRelations();

      
      
      
      //$post=Doctrine_Core::getTable("Post")->findBy($fieldName, $value)
      //$relation=Doctrine_Core::getTable("Post")->getRelation("Thread");
      //$post=new Post();
      //echo $post->getPostAutoComplete();
      //echo Doctrine_Core::getTable("Post")->getRelation("Thread");die();
          //$post=$results->getFirst();
          //$post->setName("Hello");
          //$post->save();
 //     $record=$post->getPostAutoComplete();

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

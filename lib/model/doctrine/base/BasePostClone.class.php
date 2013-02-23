<?php

/**
 * BasePostClone
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $thread_id
 * @property clob $body
 * @property string $title
 * @property integer $score
 * @property integer $post_id
 * 
 * @method integer   getThreadId()  Returns the current record's "thread_id" value
 * @method clob      getBody()      Returns the current record's "body" value
 * @method string    getTitle()     Returns the current record's "title" value
 * @method integer   getScore()     Returns the current record's "score" value
 * @method integer   getPostId()    Returns the current record's "post_id" value
 * @method PostClone setThreadId()  Sets the current record's "thread_id" value
 * @method PostClone setBody()      Sets the current record's "body" value
 * @method PostClone setTitle()     Sets the current record's "title" value
 * @method PostClone setScore()     Sets the current record's "score" value
 * @method PostClone setPostId()    Sets the current record's "post_id" value
 * 
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePostClone extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('post_clone');
        $this->hasColumn('thread_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('body', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('score', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('post_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $testable0 = new Testable(array(
             'scoreColumn' => 'score',
             'className' => 'Post',
             'clonedFields' => 
             array(
              0 => 'body',
              1 => 'title',
             ),
             ));
        $this->actAs($testable0);
    }
}
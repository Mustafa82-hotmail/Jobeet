<?php

/**
 * BasePost
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $thread_id
 * @property clob $body
 * @property string $name
 * @property integer $post_type
 * @property Thread $Thread
 * @property PostAutoComplete $AutoCompleteRecord
 * 
 * @method integer          getThreadId()           Returns the current record's "thread_id" value
 * @method clob             getBody()               Returns the current record's "body" value
 * @method string           getName()               Returns the current record's "name" value
 * @method integer          getPostType()           Returns the current record's "post_type" value
 * @method Thread           getThread()             Returns the current record's "Thread" value
 * @method PostAutoComplete getAutoCompleteRecord() Returns the current record's "AutoCompleteRecord" value
 * @method Post             setThreadId()           Sets the current record's "thread_id" value
 * @method Post             setBody()               Sets the current record's "body" value
 * @method Post             setName()               Sets the current record's "name" value
 * @method Post             setPostType()           Sets the current record's "post_type" value
 * @method Post             setThread()             Sets the current record's "Thread" value
 * @method Post             setAutoCompleteRecord() Sets the current record's "AutoCompleteRecord" value
 * 
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePost extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('post');
        $this->hasColumn('thread_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('body', 'clob', null, array(
             'type' => 'clob',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('post_type', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Thread', array(
             'local' => 'thread_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('PostAutoComplete as AutoCompleteRecord', array(
             'local' => 'id',
             'foreign' => 'post_id'));

        $autocompletesource0 = new AutoCompleteSource(array(
             'className' => 'PostAutoComplete',
             'autoCompleteField' => 'name',
             ));
        $countcache0 = new CountCache(array(
             'relations' => 
             array(
              'Thread' => 
              array(
              'cache_type' => 'attributecache',
              'columnName' => 'posts_status_number',
              'targetAttribute' => 'post_type',
              'attributeValues' => 
              array(
               0 => 0,
               1 => 1,
               2 => 2,
              ),
              'foreignAlias' => 'Posts',
              ),
             ),
             ));
        $this->actAs($autocompletesource0);
        $this->actAs($countcache0);
    }
}
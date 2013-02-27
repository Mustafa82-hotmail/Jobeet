<?php

/**
 * Post filter form base class.
 *
 * @package    jobeet
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePostFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'thread_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Thread'), 'add_empty' => true)),
      'body'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'      => new sfWidgetFormFilterInput(),
      'post_type' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'thread_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Thread'), 'column' => 'id')),
      'body'      => new sfValidatorPass(array('required' => false)),
      'name'      => new sfValidatorPass(array('required' => false)),
      'post_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'thread_id' => 'ForeignKey',
      'body'      => 'Text',
      'name'      => 'Text',
      'post_type' => 'Number',
    );
  }
}

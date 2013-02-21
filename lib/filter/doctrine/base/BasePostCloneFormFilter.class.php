<?php

/**
 * PostClone filter form base class.
 *
 * @package    jobeet
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePostCloneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'thread_id' => new sfWidgetFormFilterInput(),
      'body'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'     => new sfWidgetFormFilterInput(),
      'score'     => new sfWidgetFormFilterInput(),
      'post_id'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'thread_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'body'      => new sfValidatorPass(array('required' => false)),
      'title'     => new sfValidatorPass(array('required' => false)),
      'score'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'post_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('post_clone_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostClone';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'thread_id' => 'Number',
      'body'      => 'Text',
      'title'     => 'Text',
      'score'     => 'Number',
      'post_id'   => 'Number',
    );
  }
}

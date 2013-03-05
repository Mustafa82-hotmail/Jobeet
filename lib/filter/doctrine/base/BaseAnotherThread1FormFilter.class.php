<?php

/**
 * AnotherThread1 filter form base class.
 *
 * @package    jobeet
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnotherThread1FormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'        => new sfWidgetFormFilterInput(),
      'referenceId'   => new sfWidgetFormFilterInput(),
      'referenceType' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'         => new sfValidatorPass(array('required' => false)),
      'status'        => new sfValidatorPass(array('required' => false)),
      'referenceId'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'referenceType' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('another_thread1_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AnotherThread1';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'title'         => 'Text',
      'status'        => 'Text',
      'referenceId'   => 'Number',
      'referenceType' => 'Text',
    );
  }
}

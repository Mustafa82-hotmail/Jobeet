<?php

/**
 * AnotherThread1 form base class.
 *
 * @method AnotherThread1 getObject() Returns the current form's model object
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAnotherThread1Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'title'         => new sfWidgetFormInputText(),
      'status'        => new sfWidgetFormInputText(),
      'referenceId'   => new sfWidgetFormInputText(),
      'referenceType' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'         => new sfValidatorString(array('max_length' => 255)),
      'status'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'referenceId'   => new sfValidatorInteger(array('required' => false)),
      'referenceType' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('another_thread1[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AnotherThread1';
  }

}

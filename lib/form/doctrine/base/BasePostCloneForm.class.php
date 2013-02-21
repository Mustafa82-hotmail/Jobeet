<?php

/**
 * PostClone form base class.
 *
 * @method PostClone getObject() Returns the current form's model object
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostCloneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'thread_id' => new sfWidgetFormInputText(),
      'body'      => new sfWidgetFormTextarea(),
      'title'     => new sfWidgetFormInputText(),
      'score'     => new sfWidgetFormInputText(),
      'post_id'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'thread_id' => new sfValidatorInteger(array('required' => false)),
      'body'      => new sfValidatorString(),
      'title'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'score'     => new sfValidatorInteger(array('required' => false)),
      'post_id'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('post_clone[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PostClone';
  }

}

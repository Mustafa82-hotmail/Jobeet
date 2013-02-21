<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
  public function executeNew(sfWebRequest $request)
{
  $this->form = new JobeetJobForm();
}
 
public function executeCreate(sfWebRequest $request)
{
  $this->form = new JobeetJobForm();
  $this->processForm($request, $this->form);
  $this->setTemplate('new');
}
 

public function executeIndex(sfWebRequest $request)
{
    $this->categories=Doctrine_core::getTable('JobeetCategory')->getWithJobs();
}
public function executeEdit(sfWebRequest $request)
{
  $this->form = new JobeetJobForm($this->getRoute()->getObject());
}
 
public function executeUpdate(sfWebRequest $request)
{
  $this->form = new JobeetJobForm($this->getRoute()->getObject());
  $this->processForm($request, $this->form);
  $this->setTemplate('edit');
}
 
public function executeDelete(sfWebRequest $request)
{
  $request->checkCSRFProtection();
 
  $job = $this->getRoute()->getObject();
  $job->delete();
 
  $this->redirect('job/index');
}
 
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
      $form->bind(
        $request->getParameter($form->getName()),
        $request->getFiles($form->getName())
      );

      if ($form->isValid())
      {
        $job = $form->save();

        $this->redirect('job_show', $job);
      }
    }
    public function executeShow(sfWebRequest $request)
    {
        $this->job=$this->getRoute()->getObject();
    }
    public function executePublish(sfWebRequest $request)
    {
      $request->checkCSRFProtection();

      $job = $this->getRoute()->getObject();
      $job->publish();

      $this->getUser()->setFlash('notice', sprintf('Your job is now online for %s days.', sfConfig::get('app_active_days')));

      $this->redirect('job_show_user', $job);
    }

    public function executeSearch(sfWebRequest $request)
    {
        //$this->forwardUnless($query = $request->getParameter('query'), 'job', 'index');
 
        $this->jobs = Doctrine_Core::getTable('JobeetJob')->getActiveJobs();

        if ($request->isXmlHttpRequest())
        {
          if (!$this->jobs)
          {
            return $this->renderText('No results.');
          }

          //return $this->renderPartial('job/list', array('jobs' => $this->jobs));
          $form=new JobeetJobForm();
          
          return $this->renderPartial('job/form1',array('form' => $form));        
          
          
        }
    }
}
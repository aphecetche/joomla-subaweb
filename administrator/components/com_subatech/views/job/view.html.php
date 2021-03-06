<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewJob extends JView
{
  protected $item;
  protected $form;
  
  public function display($tpl=null)
  {
    $this->item = $this->get('Item'); // get from model
    $this->form = $this->get('Form');
      
    $this->addToolBar();
    
    parent::display($tpl);
  }
  
  public function addToolBar()
  {
  	if ($this->item->id)
  	{
  		JToolBarHelper::title(JText::_('COM_SUBATECH_EDIT_JOB_TITLE'));
  	}
  	else
  	{
  		JToolBarHelper::title(JText::_('COM_SUBATECH_ADD_JOB_TITLE'));
  	}
  	
  	JToolBarHelper::apply('job.apply','JTOOLBAR_APPLY');
  	JToolBarHelper::save('job.save','JTOOLBAR_SAVE');
  	JToolBarHelper::save2new('job.save2new','JTOOLBAR_SAVE_AND_NEW');

  	JToolBarHelper::cancel('job.cancel');
  }
   
}
<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewInternship extends JView
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
  		JToolBarHelper::title(JText::_('COM_SUBATECH_EDIT_INTERNSHIP_TITLE'));
  	}
  	else
  	{
  		JToolBarHelper::title(JText::_('COM_SUBATECH_ADD_INTERNSHIP_TITLE'));
  	}
  	
  	JToolBarHelper::apply('internship.apply','JTOOLBAR_APPLY');
  	JToolBarHelper::save('internship.save','JTOOLBAR_SAVE');
  	JToolBarHelper::save2new('internship.save2new','JTOOLBAR_SAVE_AND_NEW');

  	JToolBarHelper::cancel('internship.cancel');
  }
   
}
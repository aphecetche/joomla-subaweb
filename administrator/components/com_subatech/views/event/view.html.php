<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewEvent extends JView
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
  		JToolBarHelper::title(JText::_('COM_SUBATECH_EDIT_EVENT_TITLE'));
  	}
  	else
  	{
  		JToolBarHelper::title(JText::_('COM_SUBATECH_ADD_EVENT_TITLE'));
  	}
  	
  	JToolBarHelper::apply('event.apply','JTOOLBAR_APPLY');
  	JToolBarHelper::save('event.save','JTOOLBAR_SAVE');
  	JToolBarHelper::save2new('event.save2new','JTOOLBAR_SAVE_AND_NEW');

  	JToolBarHelper::cancel('event.cancel');
  }
   
}
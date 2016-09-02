<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewEvents extends JViewLegacy
{
  protected $items;
  protected $pagination;
  
  public function display($tpl = null)
  {
  	$this->items = $this->get('Items');
  	$this->pagination = $this->get('Pagination');
  	
  	$this->addToolbar();
  	
  	parent::display($tpl);
  }
  
  public function addToolbar()
  {
    $canDo = SubatechHelper::getActions();
    
  	JToolBarHelper::title(JText::_('COM_SUBATECH_EVENTS_LIST_TITLE'),'subatech');
  	
  	if ($canDo->get('core.create') )
  	{
  		JToolBarHelper::addNew('event.add');
  	}
  	
  	if ( ($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
  	{
  		JToolBarHelper::editList('event.edit');
  	}
  	
  	if ($canDo->get('core.edit.state'))
  	{
 		JToolBarHelper::divider();
		
//		JToolBarHelper::publish('events.publish');
//		JToolBarHelper::unpublish('events.unpublish');
		
		JToolBarHelper::publish('events.publish', 'JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('events.unpublish', 'JTOOLBAR_UNPUBLISH', true);

		JToolBarHelper::divider();
		JToolBarHelper::checkin('events.checkin');
	 	JToolBarHelper::archiveList('events.archive');
 		JToolBarHelper::trash('events.trash');
		JToolBarHelper::divider();
	}
	
 	if ($canDo->get('core.admin'))
 	{
 		JToolBarHelper::preferences('com_subatech');
 	}
  }
  
}
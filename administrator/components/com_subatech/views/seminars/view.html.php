<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewSeminars extends JView
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
    
  	JToolBarHelper::title(JText::_('COM_SUBATECH_SEMINARS_LIST_TITLE'),'subatech');
  	
  	if ($canDo->get('core.create') )
  	{
  		JToolBarHelper::addNew('seminar.add');
  	}
  	
  	if ( ($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
  	{
  		JToolBarHelper::editList('seminar.edit');
  	}
  	
  	if ($canDo->get('core.edit.state'))
  	{
 		JToolBarHelper::divider();
		
//		JToolBarHelper::publish('seminars.publish');
//		JToolBarHelper::unpublish('seminars.unpublish');
		
		JToolBarHelper::publish('seminars.publish', 'JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('seminars.unpublish', 'JTOOLBAR_UNPUBLISH', true);

		JToolBarHelper::divider();
		JToolBarHelper::checkin('seminars.checkin');
	 	JToolBarHelper::archiveList('seminars.archive');
 		JToolBarHelper::trash('seminars.trash');
		JToolBarHelper::divider();
	}
	
 	if ($canDo->get('core.admin'))
 	{
 		JToolBarHelper::preferences('com_subatech');
 	}
  }
  
}
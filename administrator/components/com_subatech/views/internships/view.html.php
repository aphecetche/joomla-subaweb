<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewInternships extends JViewLegacy
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
    
  	JToolBarHelper::title(JText::_('COM_SUBATECH_INTERNSHIPS_LIST_TITLE'),'subatech');
  	
  	if ($canDo->get('core.create') )
  	{
  		JToolBarHelper::addNew('internship.add');
  	}
  	
  	if ( ($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
  	{
  		JToolBarHelper::editList('internship.edit');
  	}
  	
  	if ($canDo->get('core.edit.state'))
  	{
 		JToolBarHelper::divider();
		
//		JToolBarHelper::publish('internships.publish');
//		JToolBarHelper::unpublish('internships.unpublish');
		
		JToolBarHelper::publish('internships.publish', 'JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('internships.unpublish', 'JTOOLBAR_UNPUBLISH', true);

		JToolBarHelper::divider();
		JToolBarHelper::checkin('internships.checkin');
	 	JToolBarHelper::archiveList('internships.archive');
 		JToolBarHelper::trash('internships.trash');
		JToolBarHelper::divider();
	}
	
 	if ($canDo->get('core.admin'))
 	{
 		JToolBarHelper::preferences('com_subatech');
 	}
  }
  
}
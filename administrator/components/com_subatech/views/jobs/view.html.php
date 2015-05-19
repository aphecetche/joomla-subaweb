<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class SubatechViewJobs extends JViewLegacy
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
    
  	JToolBarHelper::title(JText::_('COM_SUBATECH_JOBS_LIST_TITLE'),'subatech');
  	
  	if ($canDo->get('core.create') )
  	{
  		JToolBarHelper::addNew('job.add');
  	}
  	
  	if ( ($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
  	{
  		JToolBarHelper::editList('job.edit');
  	}
  	
  	if ($canDo->get('core.edit.state'))
  	{
 		JToolBarHelper::divider();
		
//		JToolBarHelper::publish('jobs.publish');
//		JToolBarHelper::unpublish('jobs.unpublish');
		
		JToolBarHelper::publish('jobs.publish', 'JTOOLBAR_PUBLISH', true);
		JToolBarHelper::unpublish('jobs.unpublish', 'JTOOLBAR_UNPUBLISH', true);

		JToolBarHelper::divider();
		JToolBarHelper::checkin('jobs.checkin');
	 	JToolBarHelper::archiveList('jobs.archive');
 		JToolBarHelper::trash('jobs.trash');
		JToolBarHelper::divider();
	}
	
 	if ($canDo->get('core.admin'))
 	{
 		JToolBarHelper::preferences('com_subatech');
 	}
  }
  
}
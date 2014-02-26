<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class SubatechViewJobs extends JView
{
	protected $items;
	protected $params;
	protected $year;
	protected $layout;
	protected $title;
    protected $jobtype;
    
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view

		$this->items = $this->get('Items');
 		$this->params = JFactory::getApplication()->getParams();
 	    $this->year = $this->get('state')->get('year');
        $this->jobtype = $this->get('state')->get('jobtype');
 	    $this->layout = $this->get('layout');

        $this->title = JText::_('COM_SUBATECH_JOBS_LIST_NAME'); 
        
        if ( $this->jobtype == "thèse" )
        {
            $this->title = JText::_('COM_SUBATECH_PHDS_LIST_NAME');
        }
         	                    
		// Display the view
		parent::display($tpl);
	}
}
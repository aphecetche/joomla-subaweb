<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class SubatechViewSeminars extends JViewLegacy
{
	protected $items;
	protected $params;
	protected $year;
	protected $layout;
	
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view

		$this->items = $this->get('Items');
 		$this->params = JFactory::getApplication()->getParams();
 	    $this->year = $this->get('state')->get('year');
 	    $this->layout = $this->get('layout');
 	          
		// Display the view
		parent::display($tpl);
	}
}
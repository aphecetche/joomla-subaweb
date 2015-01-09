<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class SubatechViewArticles extends JViewLegacy
{
	protected $items;
	protected $params;
	
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view
		$this->items = $this->get('Items');
 		$this->params = $this->get('Params');
 		
		// Display the view
		parent::display($tpl);
	}
}
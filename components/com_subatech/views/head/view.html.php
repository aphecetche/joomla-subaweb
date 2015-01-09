<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class SubatechViewHead extends JViewLegacy
{
	protected $items;
	protected $state;
	public $text;
    
	// Overwriting JView display method
	function display($tpl = null) 
	{
		// Assign data to the view
		$this->items = $this->get('Items');
 		$this->state = $this->get('State');

        JPluginHelper::importPlugin('content');
        $dispatcher = JDispatcher::getInstance();
        
        $this->text = $this->items["head"]["introtext"];
        
        $dispatcher->trigger('onContentPrepare', array ('com.subatech.featured', &$this, &$this->params, 0));        
                
        $this->items["head"]["introtext"]=$this->text;
        
		// Display the view
		parent::display($tpl);
	}
}
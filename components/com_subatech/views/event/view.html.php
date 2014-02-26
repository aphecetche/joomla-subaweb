<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.view');
 
class SubatechViewEvent extends JView
{
	protected $item;
	protected $params;
	
	function display($tpl = null) 
	{
		$this->item = $this->get('Item');
 	    $this->params = $this->get('params'); //$this->state->get('params');
 	    
 	    // FIXME : add the emailcloacking protection for events as well ?
        // (normally not needed as no email is used, but...)
        /*
        JPluginHelper::importPlugin('content');
        $dispatcher = JDispatcher::getInstance();

        $dispatcher->trigger('onContentPrepare', array ('com.subatech.internship', &$this->item->misc, &$this->params, 0));        
        $dispatcher->trigger('onContentPrepare', array ('com.subatech.internship', &$this->item->contact_email, &$this->params, 0));                
        $dispatcher->trigger('onContentPrepare', array ('com.subatech.internship', &$this->item->description, &$this->params, 0));        
        */
 	    
		parent::display($tpl);
	}
}
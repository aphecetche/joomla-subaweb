<?php
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.view');
 
class SubatechViewJob extends JViewLegacy
{
	protected $item;
	protected $params;
    
	function display($tpl = null) 
	{
		$this->item = $this->get('Item');
 	    $this->params = $this->get('params'); //$this->state->get('params');
 	    
 	    JPluginHelper::importPlugin('content');
        $dispatcher = JDispatcher::getInstance();

        // dispatch so that e.g. the email cloak plugin can run on "misc" and "description" parts of the job
        $dispatcher->trigger('onContentPrepare', array ('com.subatech.job', &$this->item->misc, &$this->params, 0));        
        $dispatcher->trigger('onContentPrepare', array ('com.subatech.job', &$this->item->description, &$this->params, 0));        
        
		parent::display($tpl);
	}
}
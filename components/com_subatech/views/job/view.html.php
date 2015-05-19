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
                
            $this->item->text = $this->item->misc;
            $dispatcher->trigger('onContentPrepare', array ('com.subatech.job', &$this->item, &$this->params, 0));
            $this->item->misc = $this->item->text;

          $this->item->text = $this->item->description;
            $dispatcher->trigger('onContentPrepare', array ('com.subatech.job', &$this->item, &$this->params, 0));
            $this->item->description = $this->item->text;

		parent::display($tpl);
	}
}
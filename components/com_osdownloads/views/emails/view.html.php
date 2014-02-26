<?php

defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.view');

class OSDownloadsViewEmails extends JView
{
    
   protected $items;
   
    function display($tpl = null)
    {
        $this->items = $this->get('Items');
                
        parent::display($tpl);
    }
    
} 
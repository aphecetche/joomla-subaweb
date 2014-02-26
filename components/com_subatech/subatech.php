<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import joomla controller library
jimport('joomla.application.component.controller');

$language = JFactory::getLanguage();

echo $language->load('com_subatech', JPATH_SITE, 'en-GB', true);
echo $language->load('com_subatech', JPATH_SITE, null, true); 
 
 // Get an instance of the controller prefixed by Seminars
$controller = JController::getInstance('Subatech');
  
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();
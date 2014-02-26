<?php
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_subatech')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Register helper class
JLoader::register('SubatechHelper', dirname(__FILE__) . '/helpers/subatech.php');

jimport('joomla.application.component.controller');

// Set some global property
$document = JFactory::getDocument();
$document->addStyleDeclaration('.icon-48-subatech {background-image: url(../media/com_subatech/images/icon-48x48.png);}');
  
$controller = JController::getInstance('Subatech');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();

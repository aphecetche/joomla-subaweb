<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class SubatechControllerInternships extends JControllerAdmin
{  
  /**
	 * Proxy for getModel.
	 *
	 * @param	string	$name	The name of the model.
	 * @param	string	$prefix	The prefix for the PHP class name.
	 *
	 * @return	JModel
	 */
  public function getModel($name='Internship',$prefix='SubatechModel', $config=array('ignore_request' => true))
  {
    $model = parent::getModel($name,$prefix,$config);
    
    return $model;
  }
}
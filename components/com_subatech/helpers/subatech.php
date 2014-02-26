<?php

defined('_JEXEC') or die;

class SubatechHelper
{
	public static $extension = "com_subatech";
	
   	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
	
		$result	= new JObject;

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 
			'core.edit', 'core.edit.own', 'core.edit.state', 
			'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action,SubatechHelper::$extension));
		}

		return $result;
	}

}

?>
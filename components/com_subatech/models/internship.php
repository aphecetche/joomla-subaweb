<?php
defined('_JEXEC') or die;
 
jimport('joomla.application.component.model');
 
class SubatechModelInternship extends JModel
{

	protected $_context = 'com_subatech.internship';

  	public function getTable($type='Internship', $prefix='SubatechTable', $config=array())
  	{
  		return JTable::getInstance($type,$prefix,$config);
  	}
  
	public function getItem()
	{
		$internship_id = JRequest::getInt("id");
		
		$row = JTable::getInstance('Internship','SubatechTable');
		$row->load($internship_id);
		
		$row->params = $this->getState('params');
		if (empty($row->params))
		{
			$row->params = new JObject();
		}
		
		$user = JFactory::getUser();

		// Check general edit permission first.
		if ($user->authorise('core.edit', 'com_subatech')) 
		{
			$row->params->set('access-edit', true);
		}
		
		$row->params->set('show_print_icon',true);
		
		return $row;
	}
}

<?php
defined('_JEXEC') or die;
 
jimport('joomla.application.component.model');
 
class SubatechModelJob extends JModelLegacy
{

	protected $_context = 'com_subatech.job';

  	public function getTable($type='Job', $prefix='SubatechTable', $config=array())
  	{
  		return JTable::getInstance($type,$prefix,$config);
  	}
  
	public function getItem()
	{
		$job_id = JRequest::getInt("id");
		
		$row = JTable::getInstance('Job','SubatechTable');
		$row->load($job_id);
		
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
		
        $ltag = str_replace("-","_",JFactory::getLanguage()->getTag());
         
        $row->description=$row->get('description_' . $ltag);
        $row->title=$row->get('title_' . $ltag);
        $row->misc=$row->get('misc_' . $ltag);
        
		return $row;
	}
}

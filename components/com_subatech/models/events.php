K<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
/**
 * Events Model
 */
class SubatechModelEvents extends JModelList
{
	public function getListQuery()
	{
		$query = parent::getListQuery();
		
		$year = $this->getState('year');
		
		$query->select('id, date_start, date_end, location, pre_summary, post_summary, title, state');
		$query->from('#__events');
		
		$user	= JFactory::getUser();
		if (!$user->authorise('core.edit.state', 'com_subatech'))
		{
			$query->where('state=1');
		}
		
		if ( $year > 1990 )
		{
			$query->where('YEAR(date_start)='.$year);
		}
		
		$query->order('date_start desc');
		
		
		return $query;
	}
	
	protected function populateState()
	{
		$app = JFactory::getApplication();

		// Load the parameters.
 		$params	= $app->getParams();
 		if (empty($params))
 		{
 		 	$params = new stdClass();
 		}
 
	 	// set access related params
 
 		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$asset	= 'com_subatech';

		// Check general edit permission first.
		if ($user->authorise('core.edit', $asset)) {
			$params->set('access-edit', true);
		}
		// Now check if edit.own is available.
		elseif (!empty($userId) && $user->authorise('core.edit.own', $asset)) {
			// Check for a valid user and that they are the owner.
			if ($userId == $value->created_by) {
				$params->set('access-edit', true);
			}
		}

		// Check edit state permission.
		$params->set('access-change', $user->authorise('core.edit.state', $asset));

		$params->set('show_print_icon',true);

 		$this->setState('params', $params);

		// layout
 		$this->setState('layout', JRequest::getCmd('layout'));

		// the year will be taken from the params or the request
		// the request will have priority
		$year = $params->get('year');
		
		$yearFromRequest = JRequest::getInt('year',$year); 
		// 0 = all years
		// < 0 = current year
		
		if ( isset($yearFromRequest) )
		{
			$year = $yearFromRequest;
		}
		
		if (!isset($year))
		{
			$year= -1;
		}
		
		if ( ($year<0) )
		{
			$year = date('Y');
		}
		
		$this->setState('year', $year);
		

	}

}
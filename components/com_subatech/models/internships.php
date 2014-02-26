<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
/**
 * Jobs Model
 */
class SubatechModelInternships extends JModelList
{
	public function getListQuery()
	{
		$query = parent::getListQuery();
		
		$schoolyear = $this->getState('schoolyear');

        $grade = $this->getState('grade');
		
		$query->select('*');
		$query->from('#__internships');
		
		$user	= JFactory::getUser();
		if (!$user->authorise('core.edit.state', 'com_subatech'))
		{
			$query->where('state=1');
		}
		
		if ( isset($schoolyear) ) 
		{
			$query->where('school_year="'.$schoolyear.'"');
            $query->order('school_year desc');
		}
				
        if  ( isset($grade ) )
        {
           $query->where('grade="'.$grade.'"');
        }
        
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
            $params->set('zozo',true);
 		}
        else
            {
            $params->set('toto',true);
                
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

		// the school year will be taken from the params or the request
		// the request will have priority
		$schoolyear = $params->get('schoolyear');
		
		$schoolyearFromRequest = JRequest::getString('schoolyear',$schoolyear); 
		
		if ( isset($schoolyearFromRequest) && strlen($schoolyearFromRequest)==9 )
		{
			$schoolyear = $schoolyearFromRequest;
            $this->setState('schoolyear', $schoolyear);
		}
		       
        $grade = $params->get('grade');
        
	    $gradeFromRequest = JRequest::getString('grade',$grade);
      
        if ( isset($gradeFromRequest))
        {
            $grade = $gradeFromRequest;
        }  

        $this->setState('grade',$grade);
               
	}

}
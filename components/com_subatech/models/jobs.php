<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.application.component.modellist');
 
/**
 * Jobs Model
 */
class SubatechModelJobs extends JModelList
{
	public function getListQuery()
	{
		$query = parent::getListQuery();
		
		$year = $this->getState('year');

        $type = $this->getState('jobtype');

        $ltag = str_replace("-","_",JFactory::getLanguage()->getTag());
		  
		$query->select('id, type, alias, date_start, date_reply, checked_out,'.
		'checked_out_time,state,created,created_by,modified,modified_by,'.
		'publish_up,publish_down,attribs,title_' . $ltag . ' as title,'.
        'description_' . $ltag . ' as description,'.
        'misc_' . $ltag . ' as misc');
		$query->from('#__jobs');
		        
		$user	= JFactory::getUser();
		if (!$user->authorise('core.edit.state', 'com_subatech'))
		{
			$query->where('state=1');
		}
		
		if ( $year )
		{
			$query->where("YEAR(date_start)=$year");
            $query->order('YEAR(date_start) desc');
		}
			
        if ($type)
        {
            if (substr($type,0,1)=='!')
            {
                $query->where('type!="' . substr($type,1) . '"');                
            }
            else
            {
                $query->where("type=\"$type\"");                
            }
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
		
		$yearFromRequest = JRequest::getString('year',$year); 
		
		if ( isset($yearFromRequest) && strlen($yearFromRequest)==4 )
		{
			$year = $yearFromRequest;
            $this->setState('year', $year);
		}
		       
        $type =$params->get('jobtype');
        
	    $typeFromRequest = JRequest::getString('jobtype',$type);
      
        if ( isset($typeFromRequest))
        {
            $type = $typeFromRequest;
        }  

        $this->setState('jobtype',$type);
               
	}

}
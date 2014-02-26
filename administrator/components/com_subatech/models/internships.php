<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SubatechModelInternships extends JModelList
{
	public function __construct($config = array())
	{
		parent::__construct($config);
  }
  
  public function getItems()
  {
  	$items = parent::getItems();
  	
  	foreach ($items as &$item)
  	{
  		$item->url = 'index.php?option=com_subatech&amp;task=internship.edit&amp;id=' . $item->id;
  	}

	return $items;
  }
  
  public function getListQuery()
  {
  	$query = parent::getListQuery();
  	
	// Select the required fields from the tablj.
	$query->select(
			$this->getState(
				'list.select',
				'j.id, j.school_year, j.type, '.
				'j.alias, j.description, ' . 
				'j.contact_name, j.contact_phone, j.contact_email, '.
				'j.checked_out, j.checked_out_time, '.
				'j.title,'.
                'j.state,j.created,j.created_by,j.modified,j.modified_by,j.publish_up,j.publish_down,'.
                'j.attribs','j.keywords,j.needed_skills,'.
                'j.internal_offer,j.enterprise_offer,'.
				'j.host_laboratory_name, j.host_laboratory.address,'.
				'j.logo1,j.logo2,j.logo3,j.misc'
			)
	);
	$query->from('#__internships AS j');


  	// Join over the users for the checked out user.
	$query->select('u.name AS editor');
	$query->join('LEFT', '#__users AS u ON u.id=j.checked_out');

  	return $query;
  }
}
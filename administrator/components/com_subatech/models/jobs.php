<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SubatechModelJobs extends JModelList
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
  		$item->url = 'index.php?option=com_subatech&amp;task=job.edit&amp;id=' . $item->id;
  	}

	return $items;
  }
  
  public function getListQuery()
  {
  	$query = parent::getListQuery();
  	
    $ltag = str_replace("-","_",JFactory::getLanguage()->getTag());
    
	// Select the required fields from the tablj.
	$query->select(
			$this->getState(
				'list.select',
				'j.id, j.date_start, j.date_reply, j.type, '.
				'j.alias, j.description_' . $ltag . ' as description,' .
				'j.checked_out, j.checked_out_time, '.
				'j.title_'. $ltag . ' as title,' .
                'j.state,j.created,j.created_by,j.modified,j.modified_by,j.publish_up,j.publish_down,'.
                'j.attribs','j.keywords,j.needed_skills,'.
                'j.misc_' . $ltag . ' as misc'
			)
	);
	$query->from('#__jobs AS j');


  	// Join over the users for the checked out user.
	$query->select('u.name AS editor');
	$query->join('LEFT', '#__users AS u ON u.id=j.checked_out');

  	return $query;
  }
}
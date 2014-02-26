<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SubatechModelEvents extends JModelList
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
  		$item->url = 'index.php?option=com_subatech&amp;task=event.edit&amp;id=' . $item->id;
  	}

	return $items;
  }
  
  public function getListQuery()
  {
  	$query = parent::getListQuery();
  	
	// Select the required fields from the table.
	$query->select(
			$this->getState(
				'list.select',
				'e.id, e.title, e.date_start, e.date_end, e.location, e.alias, e.pre_summary, e.post_summary, e.checked_out, '.
				'e.checked_out_time,e.url_more_info,'.
				'e.state,e.created,e.created_by,e.modified,e.modified_by,e.publish_up,e.publish_down'
			)
	);
	$query->from('#__events AS e');


  	// Join over the users for the checked out user.
	$query->select('u.name AS editor');
	$query->join('LEFT', '#__users AS u ON u.id=e.checked_out');

  	return $query;
  }
}
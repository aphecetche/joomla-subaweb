<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class SubatechModelSeminars extends JModelList
{
	public function __construct($config = array())
	{
/*
if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'alias', 'a.alias',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',
				'catid', 'a.catid', 'category_title',
				'state', 'a.state',
				'access', 'a.access', 'access_level',
				'created', 'a.created',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering',
				'featured', 'a.featured',
				'language', 'a.language',
				'hits', 'a.hits',
				'publish_up', 'a.publish_up',
				'publish_down', 'a.publish_down',
			);
		}
*/
		parent::__construct($config);
  }
  
  public function getItems()
  {
  	$items = parent::getItems();
  	
  	foreach ($items as &$item)
  	{
  		$item->url = 'index.php?option=com_subatech&amp;task=seminar.edit&amp;id=' . $item->id;
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
				's.id, s.author, s.author_url, s.date, s.location, s.alias, s.summary, s.checked_out, '.
				's.checked_out_time,s.title,s.author_filiation,s.author_filiation_url,s.type,s.comment,'.
				's.state,s.created,s.created_by,s.modified,s.modified_by,s.publish_up,s.publish_down'
			)
	);
	$query->from('#__seminars AS s');


  	// Join over the users for the checked out user.
	$query->select('u.name AS editor');
	$query->join('LEFT', '#__users AS u ON u.id=s.checked_out');

  	return $query;
  }
}
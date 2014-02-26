<?php
defined('_JEXEC') or die;
 
jimport('joomla.application.component.model');
jimport( 'joomla.application.categories' );

class SubatechModelArticles extends JModel
{
	public function getItems()
	{
	  	$user =& JFactory::getUser();
  		  		
		$db =& JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select('a.id,a.title,c.title,'.
		'CASE WHEN a.modified = 0 THEN a.created ELSE a.modified END as modified');
		$query->from('#__content AS a');
		$query->where('a.catid in (' . implode(',',$user->getAuthorisedCategories('com_content','core.edit')) . ')');
		$query->join('', '#__categories AS c ON c.id = a.catid');
  		$db->setQuery($query);
		
	    $items = $db->loadRowList();

/*	    
	    echo "<pre>";
	    print_r($items);
	    echo "</pre>";
*/

		return $items;
	}

	public function getParams()
	{
	    $params = array();

  		$user =& JFactory::getUser();
  		  		
		$db =& JFactory::getDBO();
		
		$query = $db->getQuery(true);
		$query->select('title');
		$query->from("#__categories");
		$query->where('id in (' . implode(',',$user->getAuthorisedCategories('com_content','core.edit')) . ')');
  		$db->setQuery($query);

		$authorized_categories = $db->loadResultArray();
  		$params["categories"] = $authorized_categories;
	    $params["user"] = $user;

		return $params;
	}

}

<?php
defined('_JEXEC') or die ;

jimport('joomla.application.component.modellist');

	function cmp($a,$b)
	{
		if ($a->date==$b->date) return 0;
		return ( $a->date > $b->date)  ?  -1:1;
	}
	
class SubatechModelHead extends JModelList
{
	public function getItems() 
	{
//		$maxage = $this->get('state')->get('parameters.menu')->get('age');

		$db = JFactory::getDbo();

		$query = $db->getQuery(true);

		$aid = $this->getState('article.id');
		$cid = $this->getState('category.id');
		
	    $query->select('id,title,introtext')
		->from('#__content')
		->where("id=$aid");

		$db -> setQuery($query);

		$items = array();
		
		$items["head"] = $db->loadAssoc();
		
		$query = $db->getQuery(true);
		
	    $query->select('id,catid,title,introtext')
		->from('#__content')
		->where("catid=$cid");
		
		$db->setQuery($query);
		
		$items["articles"] = $db->loadAssocList();
		
		return $items;
	}

    protected function populateState()
	{		
		// Load state from the request.
		
		$this->setState('article.id', JRequest::getInt('id'));
		$this->setState('category.id', JRequest::getInt('cid'));
		
		// Load the parameters.
//		$params = $app->getParams();
//		$this->setState('params', $params);		
	}
	
	public static function substring( $text, $length = 100, $replacer='...', $isStrips=true )
  	{
			$string = $isStrips ? strip_tags( $text ):$text;
			return JString::strlen( $string ) > $length ?  JHtml::_('string.truncate', $string, $length ): $string;
	}
		  
}

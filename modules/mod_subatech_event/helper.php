<?php

defined('_JEXEC') or die;

class modSubatechEventHelper
{
/**
  * Returns the list of people of group
  */
  
  static public function getRandomEvent()
  {
    // get one random event
    
    $db = JFactory::getDbo();
    
    $query = $db->getQuery(true);
        
        $query->select('id, date_start, date_end, location, pre_summary, post_summary, title, state');
        $query->from('#__events');
$query->where('id=4');

    $db->setQuery($query);
            
    return $db->loadObjectList();
    
    //$item = array( "titi" =>1, "toto" => 2);
    
  //  return $item;
  }

} // end class

?>
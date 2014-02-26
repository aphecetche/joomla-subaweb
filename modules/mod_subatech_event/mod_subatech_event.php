<?php
defined('_JEXEC') or die;

require_once(dirname(__FILE__).'/helper.php');

/*$group = $params->get("group");
$extrafilter = $params->get("extrafilter");

$items = ModLDAPSearchHelper::getItems($group,$extrafilter);
*/
 
 $item = modSubatechEventHelper::getRandomEvent();
 
 require JModuleHelper::getLayoutPath('mod_subatech_event',$params->get('layout','default'));

?>
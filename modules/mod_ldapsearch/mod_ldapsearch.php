<?php
defined('_JEXEC') or die;

require_once(dirname(__FILE__).'/helper.php');

$group = $params->get("group");
$extrafilter = $params->get("extrafilter");

$items = ModLDAPSearchHelper::getItems($group,$extrafilter);

require JModuleHelper::getLayoutPath('mod_ldapsearch',$params->get('layout'));

?>
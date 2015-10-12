<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.

foreach ($list as $i => $item) {
    $route = $item->route;
    break;
}

$rparts = explode('/',$route);

if ( count($rparts) && 
    ( strcasecmp($rparts[0],"recherche")==0 || strcasecmp($rparts[0],"research")==0 )
     && isset($rparts[2])) 
{
    //$groupName=ucfirst($rparts[2]);
    $groups = array( 
        "plasma" => "Plasma",
        "prisma" => "Prisma" ,
        "xenon" => JText::_('TPL_SUBATECH_42_XENON'),
        "erdre" => "Erdre",
        "astro" => "Astro",
        "radiochimie" => JText::_('TPL_SUBATECH_42_RADIOCHEMISTRY'),
        "theorie-haute-energie" => JText::_('TPL_SUBATECH_42_THEORIE_HE'),
        "theorie-basse-energie" => JText::_('TPL_SUBATECH_42_THEORIE_BE'),
        "high-energy-theory" => JText::_('TPL_SUBATECH_42_THEORIE_HE'),
        "low-energy-theory" => JText::_('TPL_SUBATECH_42_THEORIE_BE'),
        "theorie" => JText::_('TPL_SUBATECH_42_THEORIE'),
        "theory" => JText::_('TPL_SUBATECH_42_THEORIE'),
    );
    
    $title = JText::sprintf('TPL_SUBATECH_42_GROUPE', $groups[$rparts[2]]);
}

if (isset($title) && strlen($title)) {
?>
<h4 class="side menu title"><?php echo $title; ?></h4>
<?php
}
?>

<ul class="menu<?php echo $class_sfx;?>"<?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$item) :
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		$class .= ' current';
	}

	if (is_array($path) && in_array($item->id, $path)) {
		$class .= ' active';
	}
	elseif ($item->type == 'alias') {
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active';
		}
		elseif (is_array($path) && in_array($aliasToId, $path)) {
			$class .= ' alias-parent-active';
		}
	}

	if ($item->deeper) {
		$class .= ' deeper';
	}

	if ($item->parent) {
		$class .= ' parent';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';
    
	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
           $lp = JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
//    echo "$lp";
        
			require $lp;
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul>';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>

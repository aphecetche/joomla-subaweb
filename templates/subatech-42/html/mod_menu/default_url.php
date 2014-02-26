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
$class = $item->anchor_css ? 'class="'.$item->anchor_css.'" ' : '';
$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
		$item->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { $linktype = $item->title;
}
$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

if (stristr($linktype,"emploi du temps")) {
     // try to find the latest version of EDT-DD.MM.YYYY.pdf    
    $flink='';
    $path='images/Enseignement';
    $pdfs = JFolder::files($path, '.pdf|.PDF');
    $date = 0;
    $maxdate = new DateTime("2001/01/01");
    foreach ($pdfs as $p) {
        $p1 = JFile::stripExt($p);
        if (stripos($p1,"EDT-")===0) {
          $dateParts = explode('.',substr($p1,4));
          if ( count($dateParts)==3 ) {
            $day = sprintf($dateParts[0],"%02d");
            $month = sprintf($dateParts[1],"%02d");
            if (strlen($dateParts[2])==2) {                
                $year = sprintf($dateParts[2],"20%02d");
            }
            else {
                $check = substr($dateParts[2],0,4);
                $year = sprintf($check,"%02d");                
            }
            if (checkdate($month,$day,$year)) {
                $date = new DateTime("$year-$month-$day");
                if ( $date > $maxdate ) {
                    $flink = "$path/$p";
                    $maxdate = $date;
                }
            }
          }
        }
    } 
}

if (strlen($flink)==0) {
    return;
}
 
 switch ($item->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
endswitch;

<?php
defined('_JEXEC') or die('Restricted access');

echo "<h3 class=\"seminar-date\">" . JHtml::_('date',$displayData->date,'l j F Y à H:i',true) . "</h3>";
echo "<h4 class=\"seminar-location\">$displayData->location</h4>";

?>


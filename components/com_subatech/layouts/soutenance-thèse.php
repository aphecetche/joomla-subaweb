
<?php
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'components/com_subatech/layouts/one-seminar.css');

echo "<h1 class=\"seminar-type\">Soutenance de thèse</h1>";

echo JLayoutHelper::render('seminar-date-and-location',(object)array( 'date'=> $displayData->date, 'location' => $displayData->location));

echo "<section class=\"seminar-main\">";
echo JLayoutHelper::render('one-seminar',$displayData);
echo "</section>";

?>

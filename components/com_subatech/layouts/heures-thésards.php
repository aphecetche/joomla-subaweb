<?php
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'components/com_subatech/layouts/one-seminar.css');

echo "<h1 class=\"seminar-type\">Heures thésards</h1>";

if (strlen($displayData->chair)) {
    echo "<h2 class=\"seminar-chair\">Animé par $displayData->chair</h2>";
}

$displayData->secondPart = (strlen($displayData->title)>0);
$displayData->smallerSecondPart = false;

echo JLayoutHelper::render('seminar-with-two-parts',$displayData);

?>

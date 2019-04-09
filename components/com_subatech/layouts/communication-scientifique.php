<?php
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'components/com_subatech/layouts/one-seminar.css');

$hasNouvelleScientifique = (strlen($displayData->title)>0);

echo "<h1 class=\"seminar-type\">Colloque café - scientifique</h1>";

if ($hasNouvelleScientifique) {
	$byline = "Séminaire précédé d'une nouvelle scientifique de Subatech";
} else {
	$byline = "Séminaire (pas de nouvelle scientifique cette fois-ci)";
}

echo "<h2 class=\"seminar-byline\">$byline</h2>";

echo "<h2 class=\"seminar-chair\">Animé par $displayData->chair</h2>";

$displayData->secondPart = $hasNouvelleScientifique;
$displayData->smallerSecondPart = true;

echo JLayoutHelper::render('seminar-with-two-parts',$displayData);

?>

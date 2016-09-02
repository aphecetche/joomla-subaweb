<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

function displayTab($items,$what)
{
  $index = '"' . JText::_($what) . '"';
  
  if (count($items[$index])==0) return;
  
  echo "<h2>" . JText::_($what) . "</h2>";

echo "toto";
  
  echo "<ul id=$index>"; 
$i=0;
foreach ($items[$index] as $item) {
$date = JHtml::_('date', $item->date, JText::_('DATE_FORMAT_LC2'));

echo '<li class="vevent">';
echo '<dl>';
echo '<dt>Date</dt>';
echo '<dd class="dtstart">' . $date . '</dd>';
echo '<dt>Type</dt>';
echo '<dd>' . $item->category . '</dd>';
echo '<dt>Titre</dt>';
echo '<dd class="summary"><a href="' . $item->link . '">' . $item->title . '</a></dd>';
echo '<dt>Lieu</dt>';
echo '<dd class="location">' . $item->location . '</dd>';
echo '</dl></li>';


$i++;
	
}

echo "</ul><hr />";  	

}

?>

<ul>

<?php foreach ( array ('COM_SUBATECH_SEMINARS', 'COM_SUBATECH_EVENTS') as $what)
if (count($this->items['"' . JText::_($what) .'"'])): ?>
	<li><a href="#<?php echo JText::_($what); ?>"><?php echo JText::_($what); ?></a></li>
<?php endif; ?>

<?php foreach ( array ('COM_SUBATECH_SEMINARS', 'COM_SUBATECH_EVENTS') as $what)
displayTab($this->items,$what); ?>


<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

$head = $this->items["head"];

$array = array();

if ( $this->params->get("show-events") > 0 )
{
  $array[] =  array (  'title' => 'COM_SUBATECH_EVENTS',
                        'view' => 'events' );
}
if ( $this->params->get("show-seminars") > 0 )
{
  $array[] =  array (  'title' => 'COM_SUBATECH_SEMINARS',
                        'view' => 'seminars');                           
}
if ( $this->params->get("show-jobs") > 0 )
{
  $array[] =  array (  'title' => 'COM_SUBATECH_JOBS',
                        'view' => 'jobs',
                        'extra' => 'jobtype!=thèse');                           
}

if ( $this->params->get("show-phds") > 0 )
{
  $array[] =  array (  'title' => 'COM_SUBATECH_PHDS',
                        'view' => 'jobs',
                        'extra' => 'jobtype=thèse');                           
}

if ( $this->params->get("show-internships") > 0 )
{
  $array[] =  array (  'title' => 'COM_SUBATECH_INTERNSHIPS',
                        'view' => 'internships' );                           
}

shuffle($array);

function displayTab($items,$a)
{
  $what=$a['title'];
  
  $index = '"' . JText::_($what) . '"';
  
  if (count($items[$index])==0) return;
  
  echo '<div id="' . JText::_($what.'_ID') . '">';
  
  echo "<h2>" . JText::_($what) . "</h2>";
  
  echo "<ul>";
   
$i=0;
foreach ($items[$index] as $item) {
	
/* $date = JHtml::_('date', $item->date, JText::_('DATE_FORMAT_LC3')); */
$date = " ";

if  ( $item->date ) 
{
    $date = JHtml::_('date', $item->date,'d - m - Y'); 
    echo '<li class="vevent">';
    echo '<span class="dtstart">' . $date . ' </span>';
    echo '<span class="summary">';
    echo '<span class="summary"><a href="' . $item->link . '">' . $item->title . '</a>';
    echo '</span></li>';
}
  else
      {
    echo '<li>';
    echo ucfirst($item->type) . ' (' . $item->school_year . ') ';
    echo '<a href="' . $item->link . '">' . $item->title . '</a>';
    echo '</li>';
          
      }
$i++;
	
}

echo "</ul>"; 

$view = $a["view"];
$url = JRoute::_("index.php?option=com_subatech&view=". $view . "&year=0");
if ( array_key_exists('extra',$a) )
{
    $url .= "&" . $a['extra'];
}

echo "<a class=\"readmore\" href=\"$url\">" . JText::_('COM_SUBATECH_READMORE') . '</a>'; 	

echo "</div>"; 

}

?>


<div id="head">
<?php echo $head["introtext"]; ?>	
</div>

<div id="featured">
	
<ul id="featured-links">


<?php
foreach ( $array as $a )
{
    $what=$a['title'];
    if (count($this->items['"' . JText::_($what) .'"'])) 
    {
      echo '<li><a href="#' . JText::_($what.'_ID'). '">'. JText::_($what) . '</a></li>';
	}
} 
?>
</ul>

<div id="featured-content">
<?php foreach ( $array as $a )
displayTab($this->items,$a); ?>
</div>

</div>


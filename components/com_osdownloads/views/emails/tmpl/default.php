<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

?>

<h1><?php echo $this->items[0]->cate_name; ?> Downloaders</h1>

<?php

$emails=array();

foreach ($this->items as $item) {
    
    $emails[$item->email]=1;
}
?>

<pre>
    
<?php 
foreach ($emails as $key => $value)
{
  echo "$key\n";  
}
?>

</pre>



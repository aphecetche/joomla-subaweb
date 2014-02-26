<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
?>

<section id="job">

<?php

$type = $this->item->type;

if  ($type==="thèse")
{
    $date = new DateTime($this->item->date_start);
    
    echo "<h1>Sujet de thèse pour la rentrée " . $date->format("Y") . "</h1>";
}
?>

<h2><?php echo $this->escape($this->item->title); ?></h2>

<?php echo $this->item->description; ?>


<?php if ($this->item->misc): ?>
<p class="misc">
<?php echo $this->item->misc; ?>
</p>    
<?php endif; ?>

<?php if ($this->item->keywords): ?>
<p class="keywords">
<?php echo $this->escape($this->item->keywords); ?>
</p>    
<?php endif; ?>

</section>        


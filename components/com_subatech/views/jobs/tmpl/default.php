<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

function cmp($a,$b) {
return $a->date_start < $b->date_start;
}


usort($this->items,cmp);
?>

<h1><?php echo $this->title; ?></h1>

<div class="job list">

<p style="font-size: 1.6rem; margin-bottom: 2em">Vous recherchez un stage ? Les <a href="/fr/enseignement/propositions-de-stages">propositions de stages</a> se trouvent sous l'onglet "Enseignement".</p>

<?php foreach ($this->items as $item): ?>
    
<?php $url = 'index.php?option=com_subatech&view=job&id=' . $item->id; ?>

<div class="item">

<div class="description">
    
<?php if (!$this->params->get('access-change')): ?>
<?php echo JHtml::_('icon.print_popup',  $item, array("type" => "job")); ?>
<?php endif; ?>


<a href="<?php echo JRoute::_($url); ?>"><?php echo $this->escape($item->title) ?></a>

<?php
$date = new DateTime($item->date_start); 
$now = new DateTime("now");
$future = ( $date > $now );
if (!$future) {
   echo '<span class="expired offer">' . JText::_('COM_SUBATECH_EXPIRED_OFFER') . '</span>';
}
?>
   </div>

<div class="actions">
<?php if ($this->params->get('access-change')): ?>
<div class="state">
<?php echo JHtml::_('jgrid.published',$item->state,0,'',false); ?>
</div>
<?php endif ?>
<?php if ($this->params->get('access-edit')): ?>
<div class="edit">
<?php echo JHtml::_('icon.edit', $item, array("type" => "job")); ?>
<?php echo JHtml::_('icon.print_popup',  $item, array("type" => "job")); ?>
</div>
<?php endif; ?>
</div>

</div>

<?php endforeach ?>

</div>

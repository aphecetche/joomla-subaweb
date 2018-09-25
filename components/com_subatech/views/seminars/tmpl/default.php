<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$now = new DateTime("now");
?>


<h1><?php echo JText::_('COM_SUBATECH_SEMINAR_LIST_HEADER') . ( $this->year ? ' ('.$this->year.')' : '');?></h1>

<div class="seminar list">

<?php foreach ($this->items as $item): ?>

<?php $url = 'index.php?option=com_subatech&view=seminar&id=' . $item->id;
$date = new DateTime($item->date);
$future = (int) ( $date > $now ); 
?>

<div class="item">

<div class="basic">
<div class="title"><a href="<?php echo JRoute::_($url); ?>"><?php echo $this->escape($item->title) ?></a></div>
<div class="author"><?php echo $this->escape($item->author); ?></div>

</div>

<div class="venue">
<div class="date">
<?php if ( $future > 0 ): ?>
<?php echo JHtml::_('date',$item->date,'l j F Y'); ?>
<?php else: ?>
<?php echo JHtml::_('date',$item->date,JText::_('DATE_FORMAT_LC3')); ?>
<?php endif ?>
</div>
<?php if ( $this->params->get('show_location',1) == 1 &&  ($future > 0 )): ?>
<div class="time"><?php echo $date->format('H \h i')?></div>
<div class="location"><?php echo $this->escape($item->location) ?></div>
<?php endif ?>
</div>

<div class="actions">
<?php if ($this->params->get('access-change')): ?>
<div class="state">
<?php echo JHtml::_('jgrid.published',$item->state,0,'',false); ?>
</div>
<?php endif ?>
<?php if ($this->params->get('access-edit')): ?>
<div class="edit">
<?php echo JHtml::_('icon.edit', $item, array("type" => "seminar")); ?>
<?php echo JHtml::_('icon.print_popup',  $item, array("type" => "seminar")); ?>
</div>
<?php endif; ?>

</div>

</div>

<?php endforeach ?>

</div>

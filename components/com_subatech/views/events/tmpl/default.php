<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<h1><?php echo JText::_('COM_SUBATECH_EVENT_LIST_HEADER') . ($this->year ? ' ('.$this->year.')' : ''); ?></h1>

<ul id="eventList">
	
<?php foreach ($this->items as $item): ?>
<?php $url = 'index.php?option=com_subatech&view=event&id=' . $item->id; ?>

<li>
<dl>

<dt><?php echo JText::_('COM_SUBATECH_EVENT_DATE'); ?></dt>
<dd><?php echo JHtml::_('date',$item->date_start,JText::_('DATE_FORMAT_LC3')); ?></dd>
<?php if ($item->date_end > 0 ): ?>
<dd><?php echo JHtml::_('date',$item->date_end,JText::_('DATE_FORMAT_LC3')); ?></dd>
<?php endif ?>

<dt><?php echo JText::_('COM_SUBATECH_EVENT_TITLE'); ?></dt>
<dd><a href="<?php echo JRoute::_($url); ?>"><?php echo $this->escape($item->title) ?></a></dd>

<dt><?php echo JText::_('COM_SUBATECH_EVENT_LOCATION'); ?></dt>
<dd><?php echo $this->escape($item->location) ?></dd>

</dl>

<div class="actions">
<?php if ($this->params->get('access-change')): ?>
<div class="state">
<?php echo JHtml::_('jgrid.published',$item->state,0,'',false); ?>
</div>
<?php endif ?>
<?php if ($this->params->get('access-edit')): ?>
<div class="edit">
<?php echo JHtml::_('icon.edit', $item, array("type" => "event")); ?>
</div>
<?php endif; ?>
</div> <!-- actions -->

</li>

<?php endforeach ?>

</ul>
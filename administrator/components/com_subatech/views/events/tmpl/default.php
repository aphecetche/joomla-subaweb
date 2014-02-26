<?php 
defined('_JEXEC') or die;

$user		= JFactory::getUser();
$userId		= $user->get('id');
JHtml::_('behavior.multiselect');

?>

<form action="index.php?option=com_subatech&amp;view=events" method="post" name="adminForm" id="adminForm">

<table class="adminList">
<thead>
<tr>
	<th width="1%">
	<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
	</th>
	<th><?php echo JText::_('COM_SUBATECH_EVENT_DATE') ?></th>
	<th><?php echo JText::_('COM_SUBATECH_EVENT_TITLE') ?></th>
	<th><?php echo JText::_('COM_SUBATECH_EVENT_LOCATION_LABEL') ?></th>
	<th><?php echo JText::_('JSTATUS') ?></th>
	<th><?php echo JText::_('JGRID_HEADING_ID') ?></th>
</tr>
</thead>
<tbody>
<?php foreach ($this->items as $i => $item): 
  $canCheckin = $user->authorise('core.manage','com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
  $canChange = $user->authorise('core.edit.state', 'com_subatech') && $canCheckin;
?>
<tr class="row<?php echo $i %2 ?>">
<td class="center">
<?php echo JHtml::_('grid.id',$i,$item->id); ?>
</td>
<td>
<?php if ($item->checked_out): ?>
<?php echo JHtml::_('jgrid.checkedout',$i,$item->editor,$item->checked_out_time,'events.',$canCheckin); ?>
<?php endif; ?>
<?php $canEdit = $user->authorise('core.edit','com_subatech'); 
$date = $item->date_start . " + " . $item->date_end; ?>
<?php if ($canEdit): ?>
 <a href="<?php echo $item->url; ?>"><?php echo $date ?></a> 
<?php else: ?>
<?php echo $date ?>
<?php endif; ?>
</td>
<td>
<?php echo $this->escape($item->title) ?>
</td>

<td>
<?php echo $this->escape($item->location); ?>	
</td>

<td class="center">
<?php echo JHtml::_('jgrid.published', $item->state, $i, 'events.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
</td>
<td class="center">
<?php echo $item->id; ?>
</td>

<?php endforeach; ?>
</tbody>
</table>

<div>
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<?php echo JHtml::_('form.token'); ?>
</div>
</form>

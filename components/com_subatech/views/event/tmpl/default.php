<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
$params		= $this->item->params;
$params->set('type','event');
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<?php if ($canEdit || $params->get('show_print_icon')) : ?>
	<ul class="actions">
		<?php if ($canEdit && $params->get('show_print_icon')) : ?>
			<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
			</li>
		<?php endif; ?>
		<?php if ($canEdit) : ?>
			<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
			</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>

<h1><?php echo $this->escape($this->item->title); ?></h1>

<?php if ( $this->item->date_end > 0 ): ?>
<h2>
<?php
$start = new DateTime($this->item->date_start);
$end = new DateTime($this->item->date_end);

$day1 = (int) date_format($start,"d");
$month1 = JHtml::_('date',$this->item->date_start,"F");
$year1 = (int) date_format($start,"Y");

$day2 = (int) date_format($end,"d");
$month2 = JHtml::_('date',$this->item->date_end,"F");
$year2 = (int) date_format($end,"Y");

if ( $year1 === $year2 && $month1 === $month2 ) {
echo JText::sprintf('COM_SUBATECH_EVENT_VIEW_DATERANGE1',$day1,$day2,$month1,$year1);    
}
else if ( $year1 === $year2 ) {
echo JText::sprintf('COM_SUBATECH_EVENT_VIEW_DATERANGE2',$day1,$month1,$day2,$month2,$year2);    
}
else {
echo JText::sprintf('COM_SUBATECH_EVENT_VIEW_DATERANGE3',$day1,$month1,$year1,$day2,$month2,$year2);        
}

?>    
</h2>
<?php else: ?>
<h2><?php echo JHtml::_('date',$this->item->date_start,JText::_('DATE_FORMAT_LC3')); ?></h2>
<?php endif ?>

<h3><?php echo $this->escape($this->item->location) ?></h3>

<?php if ($this->item->pre_summary): ?>
<section>
<?php echo $this->item->pre_summary; ?>
</section>
<?php endif; ?>

<?php if ($this->item->post_summary): ?>
<section>
<header>Résumé</header>
<?php echo $this->item->post_summary; ?>
</section>
<?php endif; ?>
	

<?php if ($this->item->url_more_info): ?>
<footer>
<a href="<?php echo $this->item->url_more_info ?>" >pour en savoir plus...</a>
</footer>
<?php endif; ?>

<!--<footer>
<?php $url = 'index.php?option=com_subatech&view=events'; ?>
<a href="<?php echo JRoute::_($url); ?>"><?php echo JText::_('COM_SUBATECH_EVENTS_LIST_RETURN') ?></a>
</footer>
-->

</div>

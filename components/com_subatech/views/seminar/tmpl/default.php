<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
$params		= $this->item->params;
$params->set('type','seminar');
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$date = new DateTime($this->item->date); 
$now = new DateTime("now");
$future = ( $date > $now );
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

<header class="seminar item">
<h1><?php echo $this->escape($this->item->title); ?></h1>
<h2><?php echo $this->escape($this->item->author); ?></h2>
<h3><?php echo $this->escape($this->item->author_filiation); ?></h3>
</header>

<div class="seminar item">


<div class="date">
<?php echo JHtml::_('date',$this->item->date,'l j F Y') ; ?>
<?php if ( $future ): ?>
<?php echo ' @ ' . $date->format('H\hi') ?>
<?php endif; ?>
</div>

<?php if ( $future ): ?>
<span class="location">
<?php echo $this->escape($this->item->location) ?>
</span>
<?php endif; ?>

<div class="summary">
<?php echo $this->item->summary ?>
</div>
<div class="comment">
<?php echo $this->item->comment ?>
</div>

<!--
<footer>
<?php $url = 'index.php?option=com_subatech&view=seminars'; ?>
<a href="<?php echo JRoute::_($url); ?>"><?php echo JText::_('COM_SUBATECH_SEMINARS_LIST_RETURN') ?></a>
</footer>
-->

</div>

<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
?>

<div class="seminar item">

<span class="venue">Le
<?php $semdate = new DateTime($this->item->date); ?>
<?php echo JHtml::_('date',$this->item->date,'l j F Y'); ?>, à partir de
<?php echo $semdate->format('H\hi') ?>,
<?php echo $this->escape($this->item->location) ?>
</span>

<span class="type">

<?php if ( $this->item->type == "spécialisé" ): ?>
<?php echo JText::_('COM_SUBATECH_SEMINAR').' '.JText::_('COM_SUBATECH_SEMINAR_TYPE_SPECIALISE'); ?>
<?php elseif ( $this->item->type == "généraliste" ): ?>
<?php echo JText::_('COM_SUBATECH_SEMINAR').' '. JText::_('COM_SUBATECH_SEMINAR_TYPE_GENERALISTE'); ?>
<?php elseif ( $this->item->type == 'ITA'): ?>
<?php echo JText::_('COM_SUBATECH_SEMINAR').' '.JText::_('COM_SUBATECH_SEMINAR_TYPE_ITA'); ?>
<?php elseif ( $this->item->type == 'communication-scientifique'): ?>
<?php echo JText::_('COM_SUBATECH_SEMINAR_TYPE_COMMUNICATION_SCIENTIFIQUE'); ?>
<?php elseif ( $this->item->type == 'heures-thesards'): ?>
<?php echo JText::_('COM_SUBATECH_SEMINAR_TYPE_HEURES_THESARDS'); ?>
<?php endif ?>
</span>

<header>
<h1><?php echo $this->escape($this->item->title); ?></h1>
<h2><?php echo $this->escape($this->item->author); ?></h2>
<h3><?php echo $this->escape($this->item->author_filiation); ?></h3>
</header>

<div class="summary">
<?php echo $this->item->summary ?>
</div>
<div class="comment">
<?php echo $this->item->comment ?>
</div>

<?php if ($this->item->type == "communication-scientifique") { ?>
<header style="margin-top: 2em;">
<h1><?php echo $this->escape($this->item->title2); ?></h1>
<h2><?php echo $this->escape($this->item->author2); ?></h2>
<h3><?php echo $this->escape($this->item->author_filiation2); ?></h3>
</header>
<div class="summary">
<?php echo $this->item->summary2 ?>
</div>
<?php }; ?>

</div>

<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<h1><?php echo $this->title . ($this->schoolyear ? ' ('.$this->schoolyear.')' : ''); ?></h1>

<div class="job list">

<?php foreach ($this->items as $item): ?>
    
<?php $url = 'index.php?option=com_subatech&view=internship&id=' . $item->id; ?>

<div class="item">

<div class="description">
    
    <?php if (!$this->params->get('access-change')): ?>
<?php echo JHtml::_('icon.print_popup',  $item, array("type" => "job")); ?>
<?php endif; ?>


<a href="<?php echo JRoute::_($url); ?>"><?php echo $this->escape($item->title) ?></a>

<?php if ($item->logo2): ?>
 <img src="<?php echo $item->logo2; ?>" height="30px" />
<?php endif; ?>

<?php if ($item->logo3): ?>
 <img src="<?php echo $item->logo3; ?>" height="30px" />
<?php endif; ?>

<p class="place"><?php echo $item->host_laboratory_name . " " . $item->host_laboratory_address; ?>
</p>
   
<?php if (!$this->jobtype): /* only show type if not specified in the request */ ?>
<div class="type">
<?php echo $this->escape($item->type) ?>
</div>
<?php endif; ?>

</div>

<div class="actions">
<?php if ($this->params->get('access-change')): ?>
<div class="state">
<?php echo JHtml::_('jgrid.published',$item->state,0,'',false); ?>
</div>
<?php endif ?>
<?php if ($this->params->get('access-edit')): ?>
<div class="edit">
<?php echo JHtml::_('icon.edit', $item, array("type" => "internship")); ?>
<?php echo JHtml::_('icon.print_popup',  $item, array("type" => "internship")); ?>
</div>
<?php endif; ?>
</div>

</div>

<?php endforeach ?>

</div>
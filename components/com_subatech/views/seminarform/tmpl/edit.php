<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');

// Create shortcut to parameters.
$state = $this->get('state');

?>


<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'seminar.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			<?php echo $this->form->getField('summary')->save(); ?>
			Joomla.submitform(task);
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<div class="edit item-page">

<form action="<?php echo JRoute::_('index.php?option=com_subatech&s_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<fieldset>
		<legend><?php echo JText::_('COM_SUBATECH_SEMINAR'); ?></legend>

			<div class="formelm">
			<?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?>
			</div>

		<?php if (is_null($this->item->id)):?>
			<div class="formelm">
			<?php echo $this->form->getLabel('alias'); ?>
			<?php echo $this->form->getInput('alias'); ?>
			</div>
		<?php endif; ?>

		<div class="formelm">
			<?php echo $this->form->getLabel('type'); ?>
			<?php echo $this->form->getInput('type'); ?>
		</div>

		<div class="formelm">
			<?php echo $this->form->getLabel('editor'); ?>
			<?php echo $this->form->getInput('editor'); ?>
		</div>
		
			<div class="formelm-buttons">
			<button type="button" onclick="Joomla.submitbutton('seminar.save')">
				<?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" onclick="Joomla.submitbutton('seminar.cancel')">
				<?php echo JText::_('JCANCEL') ?>
			</button>
			</div>

			<?php echo $this->form->getInput('summary'); ?>

	</fieldset>
	

	<fieldset>
		<legend><?php echo JText::_('COM_SUBATECH_SEMINAR_AUTHOR'); ?></legend>
		<div class="formelm">
		<?php echo $this->form->getLabel('author'); ?>
		<?php echo $this->form->getInput('author'); ?>
		</div>
		<div class="formelm">
		<?php echo $this->form->getLabel('author_url'); ?>
		<?php echo $this->form->getInput('author_url'); ?>
		</div>
		<div class="formelm">
		<?php echo $this->form->getLabel('author_filiation'); ?>
		<?php echo $this->form->getInput('author_filiation'); ?>
		</div>
		<div class="formelm">
		<?php echo $this->form->getLabel('author_filiation_url'); ?>
		<?php echo $this->form->getInput('author_filiation_url'); ?>
		</div>

	</fieldset>

	<fieldset>
		<legend><?php echo JText::_('COM_SUBATECH_SEMINAR_VENUE'); ?></legend>
		<div class="formelm">
		<?php echo $this->form->getLabel('location'); ?>
		<?php echo $this->form->getInput('location'); ?>
		</div>
		<div class="formelm">
		<?php echo $this->form->getLabel('date'); ?>
		<?php echo $this->form->getInput('date'); ?>
		</div>
	</fieldset>

	<?php if ($this->item->params->get('access-change')):  ?> 
	<fieldset>
		<legend><?php echo JText::_('JSTATUS'); ?></legend>
		
		<div class="formelm">
		<?php echo $this->form->getLabel('state'); ?>
		<?php echo $this->form->getInput('state'); ?>
		</div>

		<div class="formelm">
		<?php echo $this->form->getLabel('publish_up'); ?>
		<?php echo $this->form->getInput('publish_up'); ?>
		</div>
		<div class="formelm">
		<?php echo $this->form->getLabel('publish_down'); ?>
		<?php echo $this->form->getInput('publish_down'); ?>
		</div>
	</fieldset>
	<?php endif; ?>

	<fieldset>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</fieldset>
</form>
</div>

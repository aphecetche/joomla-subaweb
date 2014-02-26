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
		if (task == 'internship.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task);
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<div class="edit item-page">

<form action="<?php echo JRoute::_('index.php?option=com_subatech&s_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<fieldset>
		<legend><?php echo JText::_('COM_SUBATECH_INTERNSHIP'); ?></legend>

			<div class="formelm">
			<?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?>
			</div>

            <div class="formelm">
            <?php echo $this->form->getLabel('school_year'); ?>
            <?php echo $this->form->getInput('school_year'); ?>
            </div>

            <div class="formelm">
            <?php echo $this->form->getLabel('logo1'); ?>
            <?php echo $this->form->getInput('logo1'); ?>
            </div>

            <div class="formelm">
            <?php echo $this->form->getLabel('logo2'); ?>
            <?php echo $this->form->getInput('logo2'); ?>
            </div>

            <div class="formelm">
            <?php echo $this->form->getLabel('logo3'); ?>
            <?php echo $this->form->getInput('logo3'); ?>
            </div>

		<div class="formelm">
		<?php echo $this->form->getLabel('type'); ?>
		<?php echo $this->form->getInput('type'); ?>
		</div>

		<?php if (is_null($this->item->id)):?>
			<div class="formelm">
			<?php echo $this->form->getLabel('alias'); ?>
			<?php echo $this->form->getInput('alias'); ?>
			</div>
		<?php endif; ?>

			<div class="formelm-buttons">
			<button type="button" onclick="Joomla.submitbutton('internship.save')">
				<?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" onclick="Joomla.submitbutton('internship.cancel')">
				<?php echo JText::_('JCANCEL') ?>
			</button>
			</div>

		<div class="formelm">
			<?php echo $this->form->getLabel('description'); ?>
			<?php echo $this->form->getInput('description'); ?>
		</div>

		
	</fieldset>
	

	<fieldset>
		<legend><?php echo JText::_('COM_SUBATECH_HOST'); ?></legend>
		<div class="formelm">
		<?php echo $this->form->getLabel('internal_offer'); ?>
		<?php echo $this->form->getInput('internal_offer'); ?>
        <?php echo $this->form->getLabel('enterprise_offer'); ?>
        <?php echo $this->form->getInput('enterprise_offer'); ?>
        </div>
				<div class="formelm">
			<?php echo $this->form->getLabel('host_laboratory_name'); ?>
			<?php echo $this->form->getInput('host_laboratory_name'); ?>
		</div>
                <div class="formelm">
            <?php echo $this->form->getLabel('host_laboratory_address'); ?>
            <?php echo $this->form->getInput('host_laboratory_address'); ?>
        </div>

		<div class="formelm">
			<?php echo $this->form->getLabel('contact_name'); ?>
			<?php echo $this->form->getInput('contact_name'); ?>
		</div>
        <div class="formelm">
            <?php echo $this->form->getLabel('contact_email'); ?>
            <?php echo $this->form->getInput('contact_email'); ?>
        </div>
        <div class="formelm">
            <?php echo $this->form->getLabel('contact_phone'); ?>
            <?php echo $this->form->getInput('contact_phone'); ?>
        </div>

		
	</fieldset>

            <div class="formelm-buttons">
            <button type="button" onclick="Joomla.submitbutton('internship.save')">
                <?php echo JText::_('JSAVE') ?>
            </button>
            <button type="button" onclick="Joomla.submitbutton('internship.cancel')">
                <?php echo JText::_('JCANCEL') ?>
            </button>
            </div>

    <fieldset>
        <legend><?php echo JText::_('COM_SUBATECH_EXTRA'); ?></legend>
        <div class="formelm">
        <?php echo $this->form->getLabel('keywords'); ?>
        <?php echo $this->form->getInput('keywords'); ?>
        </div>
                <div class="formelm">
            <?php echo $this->form->getLabel('needed_skills'); ?>
            <?php echo $this->form->getInput('needed_skills'); ?>
        </div>

        <div class="formelm">
            <?php echo $this->form->getLabel('misc'); ?>
            <?php echo $this->form->getInput('misc'); ?>
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

            <div class="formelm-buttons">
            <button type="button" onclick="Joomla.submitbutton('internship.save')">
                <?php echo JText::_('JSAVE') ?>
            </button>
            <button type="button" onclick="Joomla.submitbutton('internship.cancel')">
                <?php echo JText::_('JCANCEL') ?>
            </button>
            </div>


	<fieldset>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</fieldset>
</form>

</div>

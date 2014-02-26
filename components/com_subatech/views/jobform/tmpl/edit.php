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
		if (task == 'job.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			<?php echo $this->form->getField('description_fr_FR')->save(); ?>
			Joomla.submitform(task);
		} else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<div class="edit item-page">

<form action="<?php echo JRoute::_('index.php?option=com_subatech&s_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<fieldset>
		<legend><?php echo JText::_('COM_SUBATECH_JOB'); ?></legend>

			<div class="formelm">
			<?php echo $this->form->getLabel('title_fr_FR'); ?>
			<?php echo $this->form->getInput('title_fr_FR'); ?>
			</div>

            <div class="formelm">
            <?php echo $this->form->getLabel('title_en_GB'); ?>
            <?php echo $this->form->getInput('title_en_GB'); ?>
            </div>

            <div class="formelm">
            <?php echo $this->form->getLabel('date_start'); ?>
            <?php echo $this->form->getInput('date_start'); ?>
            </div>

            <div class="formelm">
            <?php echo $this->form->getLabel('date_reply'); ?>
            <?php echo $this->form->getInput('date_reply'); ?>
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
			<button type="button" onclick="Joomla.submitbutton('job.save')">
				<?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" onclick="Joomla.submitbutton('job.cancel')">
				<?php echo JText::_('JCANCEL') ?>
			</button>
			</div>

		<div class="formelm">
			<?php echo $this->form->getLabel('description_fr_FR'); ?>
			<?php echo $this->form->getInput('description_fr_FR'); ?>
		</div>

        <div class="formelm">
            <?php echo $this->form->getLabel('description_en_GB'); ?>
            <?php echo $this->form->getInput('description_en_GB'); ?>
        </div>

		
	</fieldset>
	

            <div class="formelm-buttons">
            <button type="button" onclick="Joomla.submitbutton('job.save')">
                <?php echo JText::_('JSAVE') ?>
            </button>
            <button type="button" onclick="Joomla.submitbutton('job.cancel')">
                <?php echo JText::_('JCANCEL') ?>
            </button>
            </div>

<fieldset>
    
<?php for ($i=1; $i <= 5 ; $i++) {
    echo ' <div class="formelm">'; 
	echo $this->form->getLabel('logo'.$i);
    echo $this->form->getInput('logo'.$i);
    echo '</div>';
}
?>            
    </fieldset>
    
    <fieldset>
        <legend><?php echo JText::_('COM_SUBATECH_EXTRA'); ?></legend>
        

        <div class="formelm">
        <?php echo $this->form->getLabel('group'); ?>
        <?php echo $this->form->getInput('group'); ?>
        </div>
        
        <div class="formelm">
        <?php echo $this->form->getLabel('keywords'); ?>
        <?php echo $this->form->getInput('keywords'); ?>
        </div>
                <div class="formelm">
            <?php echo $this->form->getLabel('needed_skills'); ?>
            <?php echo $this->form->getInput('needed_skills'); ?>
        </div>

        <div class="formelm">
            <?php echo $this->form->getLabel('misc_fr_FR'); ?>
            <?php echo $this->form->getInput('misc_fr_FR'); ?>
        </div>
       
       
        <div class="formelm">
            <?php echo $this->form->getLabel('misc_en_GB'); ?>
            <?php echo $this->form->getInput('misc_en_GB'); ?>
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
            <button type="button" onclick="Joomla.submitbutton('job.save')">
                <?php echo JText::_('JSAVE') ?>
            </button>
            <button type="button" onclick="Joomla.submitbutton('job.cancel')">
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

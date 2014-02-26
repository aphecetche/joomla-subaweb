<?php
defined('_JEXEC') or die;
?>
<form action="index.php?option=com_subatech&amp;id=<?php echo $this->item->id ?>"
 method="post" name="adminForm" class="form-validate">
 
 <div class="width-60 fltlft">
 	<fieldset class="adminform">
 		<ul class="adminformlist">
 		
 				<li><?php echo $this->form->getLabel('title'); ?>
				<?php echo $this->form->getInput('title'); ?></li>

				<li><?php echo $this->form->getLabel('alias'); ?>
				<?php echo $this->form->getInput('alias'); ?></li>

				<li><?php echo $this->form->getLabel('state'); ?>
				<?php echo $this->form->getInput('state'); ?></li>

				<li><?php echo $this->form->getLabel('url_more_info'); ?>
				<?php echo $this->form->getInput('url_more_info'); ?></li>

	<li>			<?php echo $this->form->getLabel('contacts'); ?>
			<?php echo $this->form->getInput('contacts'); ?></li>

 		</ul>


			<div class="clr"></div>
			<?php echo $this->form->getLabel('description'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('description'); ?>


			<div class="clr"></div>
			<?php echo $this->form->getLabel('how_to_apply'); ?>
			<div class="clr"></div>
			<?php echo $this->form->getInput('how_to_apply'); ?>

			
 	</fieldset>
 </div>

 <div class="width-40 fltlft">
 	
 	<fieldset class="adminform">
 		<ul class="adminformlist">
 			<?php foreach ($this->form->getFieldset("details") as $field): ?>
 			  <li><?php echo $field->label; ?>
 			  <?php echo $field->input; ?></li>
 			<?php endforeach ?>
 		</ul>
 	</fieldset>

 </div>
 
 <input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>
</form>
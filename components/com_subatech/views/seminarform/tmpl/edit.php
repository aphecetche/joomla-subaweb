<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');

// Create shortcut to parameters.
$state = $this->get('state');

$document = JFactory::getDocument();
$document->addScriptDeclaration('
function showPart2(value) {
    if (value === "communication-scientifique" ||
        value === "heures-thésards") {
        return true
    }
    return false
}

document.addEventListener("DOMContentLoaded", function() {
    var part2 = document.querySelector(".seminar-part2");
    part2.style.border = "10px solid #EEE";

    var radio = document.querySelectorAll("input[type=radio]");
    var startVisible = false;
    for (var i = 0; i < radio.length; i++) {
        radio[i].onclick = function() {
            if (showPart2(this.value)) {
                part2.style.display = "block";
            } else {
                part2.style.display = "none";
            }
            if (showPart2(radio[i].value) && radio[i].checked) {
                startVisible = true;
            }
        }
    }

    var c = document.querySelector("input[type=radio]:checked");
    if (showPart2(c.value)) {
        part2.style.display = "block";
    } else {
        part2.style.display = "none";
    }
});
');
?>

<script type = "text/javascript" >
    Joomla.submitbutton = function(task) {
        if (task == 'seminar.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
            <?php echo $this->form->getField('summary')->save(); ?>
            Joomla.submitform(task);
        } else {
            alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED '));?>');
        }
    }
</script>

<div class = "edit item-page" >

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

    <div class="formelm-buttons">
    <button type="button" onclick="Joomla.submitbutton('seminar.save')">
        <?php echo JText::_('JSAVE') ?>
    </button>
    <button type="button" onclick="Joomla.submitbutton('seminar.cancel')">
        <?php echo JText::_('JCANCEL') ?>
    </button>
    </div>

    <div class="formelm">
        <?php echo $this->form->getLabel('summary'); ?>
        <?php echo $this->form->getInput('summary'); ?>
    </div>

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

<fieldset class="seminar-part2">
    <legend><?php echo JText::_('COM_SUBATECH_SEMINAR_PART2'); ?></legend>
    <div class="formelm">
    <?php echo $this->form->getLabel('chair'); ?>
    <?php echo $this->form->getInput('chair'); ?>
    </div>
    <div class="formelm">
    <?php echo $this->form->getLabel('title2'); ?>
    <?php echo $this->form->getInput('title2'); ?>
    </div>
    <div class="formelm">
    <?php echo $this->form->getLabel('summary2'); ?>
    <?php echo $this->form->getInput('summary2'); ?>
    </div>
    <div class="formelm">
    <?php echo $this->form->getLabel('author2'); ?>
    <?php echo $this->form->getInput('author2'); ?>
    </div>
    <div class="formelm">
    <?php echo $this->form->getLabel('author_url2'); ?>
    <?php echo $this->form->getInput('author_url2'); ?>
    </div>
    <div class="formelm">
    <?php echo $this->form->getLabel('author_filiation2'); ?>
    <?php echo $this->form->getInput('author_filiation2'); ?>
    </div>
    <div class="formelm">
    <?php echo $this->form->getLabel('author_filiation_url2'); ?>
    <?php echo $this->form->getInput('author_filiation_url2'); ?>
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
    <?php echo JHtml::_('form.token'); ?>
</fieldset>
</form>
</div>

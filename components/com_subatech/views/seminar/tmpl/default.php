<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$params     = $this->item->params;
$params->set('type','seminar');
$canEdit    = $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<!-- Showing the edit buttons if allowed to -->

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

<section class="seminar-container">

<!-- Dispatch rendering to relevant layout as a function of seminar type  -->
<?php
$label = $this->escape($this->item->type);
$layout = new JLayoutFile($label,null,array('debug'=>false));
echo $layout->render($this->item);
?>

</section>


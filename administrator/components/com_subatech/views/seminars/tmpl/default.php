<?php
defined('_JEXEC') or die;

$user       = JFactory::getUser();
$userId     = $user->get('id');
JHtml::_('behavior.multiselect');

?>

<form action="index.php?option=com_subatech&amp;view=seminars" method="post" name="adminForm" id="adminForm">

  <fieldset id="filter-bar">
    <div class="filter-search fltlft">
      <label class="filter-search-lbl" for="filter_search">
        <?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
      <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_WEBLINKS_SEARCH_IN_TITLE'); ?>" />
      <button type="submit">
        <?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
      <button type="button" onclick="document.id('filter_search').value='';this.form.submit();">
        <?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
    </div>
    <div class="filter-select fltrt">
      <select name="filter_published" class="inputbox" onchange="this.form.submit()">
        <option value="">
          <?php echo JText::_('JOPTION_SELECT_PUBLISHED');?>
        </option>
        <?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true);?>
      </select>
    </div>
  </fieldset>

  <div class="clr"> </div>

  <table class="adminList">
    <thead>
      <tr>
        <th width="1%">
          <input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
        </th>
        <th>
          <?php echo JText::_('COM_SUBATECH_SEMINAR_AUTHOR') ?>
        </th>
        <th>
          <?php echo JText::_('COM_SUBATECH_SEMINAR_TITLE') ?>
        </th>
        <th>
          <?php echo JText::_('JSTATUS') ?>
        </th>
        <th>
          <?php echo JText::_('JGRID_HEADING_ID') ?>
        </th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <td colspan="5">
          <?php echo $this->pagination->getListFooter(); ?>
        </td>
      </tr>
    </tfoot>

    <tbody>

      <?php foreach ($this->items as $i => $item):
$canCheckin = $user->authorise('core.manage', 'com_checkin') || $item->checked_out == $userId || $item->checked_out == 0;
$canChange = $user->authorise('core.edit.state', 'com_subatech') && $canCheckin;
?>
      <tr class="row<?php echo $i %2 ?>">
        <td class="center">
          <?php echo JHtml::_('grid.id', $i, $item->id); ?>
        </td>
        <td>
          <?php if ($item->checked_out): ?>
          <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'seminars.', $canCheckin); ?>
          <?php endif; ?>
          <?php $canEdit = $user->authorise('core.edit', 'com_subatech'); ?>
          <?php if ($canEdit): ?>
          <a href="<?php echo $item->url; ?>">
            <?php echo $this->escape($item->author) ?></a>
          <?php else: ?>
          <?php echo $this->escape($item->author) ?>
          <?php endif; ?>
        </td>
        <td>
          <?php echo $this->escape($item->title) ?>
        </td>
        <td class="center">
          <?php echo JHtml::_('jgrid.published', $item->state, $i, 'seminars.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
        </td>
        <td class="center">
          <?php echo $item->id; ?>
        </td>

        <?php endforeach; ?>


    </tbody>

  </table>


  <div>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo JHtml::_('form.token'); ?>
  </div>
</form>

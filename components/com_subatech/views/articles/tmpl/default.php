<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();

?>

<?php if (count($this->items)): ?>

<h1><?php echo JText::_('COM_SUBATECH_AUTHORIZED_ARTICLES_LIST_HEADER'); ?></h1>


<table class="authorized_article_list">
<thead>
<tr>
<th><?php echo JText::_('COM_SUBATECH_AUTHORIZED_ARTICLES_HEAD_TITLE'); ?></th>
<th><?php echo JText::_('COM_SUBATECH_AUTHORIZED_ARTICLES_HEAD_CATEGORY'); ?></th>
<th><?php echo JText::_('COM_SUBATECH_AUTHORIZED_ARTICLES_HEAD_LASTMOD'); ?></th>
</tr>
</thead>

<?php foreach ($this->items as $item): ?>
<?php $url = 'index.php?option=com_content&view=article&id=' . $item[0]; ?>

<tr>
<td class="authorized_article_title"><a href="<?php echo JRoute::_($url); ?>">
<?php echo $this->escape($item[1]) ?></a>
</td>
<td class="authorized_article_category">
<?php echo $this->escape($item[2]) ?>
</td>
<td class="authorized_date_modified">
<?php echo $this->escape($item[3]) ?>
</td>
</tr>

<?php endforeach ?>

<?php else: ?>

<h1><?php echo JText::_('COM_SUBATECH_AUTHORIZED_ARTICLES_NONE'); ?></h1>

<?php endif ?>

</table>
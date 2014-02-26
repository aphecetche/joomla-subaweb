<?php defined( '_JEXEC' ) or die; 

/* this one view should use pictures (a la mecanique) */

?>

<table class="membres">
<tr>
<th><?php echo JText::_('MOD_LDAPSEARCH_THNAME') ?></th>
<th><?php echo JText::_('MOD_LDAPSEARCH_THTITLE') ?></th>
<th><?php echo JText::_('MOD_LDAPSEARCH_THROOMNUMBER') ?></th>
<th><?php echo JText::_('MOD_LDAPSEARCH_THTELEPHONENUMBER') ?></th>
<th><?php echo JText::_('MOD_LDAPSEARCH_THMAIL') ?></th>
</tr>

<?php foreach ($items as $item): ?>

<tr>

<td>
<?php echo htmlspecialchars($item['cn']) ?>
</td>
<td>
<?php echo htmlspecialchars($item['title']) ?>
</td>
<td>
<?php echo htmlspecialchars($item['roomNumber']) ?>
</td>
<td>
<?php echo htmlspecialchars($item['telephoneNumber']) ?>
</td>
<td>
<?php echo htmlspecialchars($item['mail']) ?>
</td>

</tr>

<?php endforeach ?>

</table>
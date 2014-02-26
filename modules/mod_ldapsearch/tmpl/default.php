<?php defined( '_JEXEC' ) or die; ?>

<ul>
<?php foreach ($items as $item): ?>
<li>
<?php echo htmlspecialchars($item['cn']).' - '.htmlspecialchars($item['title']) 
.' - '.htmlspecialchars($item['roomNumber']).' - '.htmlspecialchars($item['telephoneNumber'])
.' - '.htmlspecialchars($item['mail'])
?>
</li>
<?php endforeach ?>
</ul>

<?php if (count($items) == 0): ?>

<p class="ldapnotreacheable">
<?php echo JText::_('MOD_LDAPSEARCH_LDAPNOTREACHEABLE') ?>
</p>

<?php endif; ?>

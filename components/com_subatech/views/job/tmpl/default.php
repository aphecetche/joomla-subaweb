<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
$params		= $this->item->params;
$params->set('type','job');
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

<?php 

$type = $this->item->type;

if  ($type==="thèse")
{
    $date = new DateTime($this->item->date_start);
    
    echo "<h1>Sujet de thèse pour la rentrée " . $date->format("Y") . "</h1>";
}

  $groups = array( 
        "plasma" => "Plasma",
        "prisma" => "Prisma" ,
        "xenon" => JText::_('COM_SUBATECH_GROUPS_XENON'),
        "erdre" => "Erdre",
        "astro" => "Astro",
        "radiochimie" => JText::_('COM_SUBATECH_GROUPS_RADIOCHEMISTRY'),
        "theorie-haute-energie" => JText::_('COM_SUBATECH_GROUPS_THEORIE_HE'),
        "theorie-basse-energie" => JText::_('COM_SUBATECH_GROUPS_THEORIE_BE'),
        "high-energy-theory" => JText::_('COM_SUBATECH_GROUPS_THEORIE_HE'),
        "low-energy-theory" => JText::_('COM_SUBATECH_GROUPS_THEORIE_BE')
    );
    
?>

<h2><?php echo $this->escape($this->item->title); ?>
    
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

</h2>

<section class="job">
<?php echo $this->item->description; ?>
</section>

<?php if ($this->item->misc): ?>
<section class="job">
<?php echo $this->item->misc; ?>    
</section>
<?php endif; ?>

<?php
/* 
if ($this->item->group) {
        
            $ltag = explode('-',JFactory::getLanguage()->getTag());
            
        
    
echo '<p><a href="/' . $ltag[0] . '/' . $this->item->group . '">'. JText::sprintf('COM_SUBATECH_GROUPS_GROUPE', $this->item->group) . '</a></p>';
    }
 */
?>


<?php if ($this->item->keywords): ?>
<p class="keywords">
<?php echo $this->escape($this->item->keywords); ?>
</p>    
<?php endif; ?>

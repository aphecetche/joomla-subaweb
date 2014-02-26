<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
$params		= $this->item->params;
$params->set('type','internship');
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>

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

<header id="internship-logos">
<?php 
$nlogos=0; 
if ($this->item->logo1) {$nlogos++;}
if ($this->item->logo2) {$nlogos++;}
if ($this->item->logo3) {$nlogos++;}
$height="75px";
?>
<?php if ($this->item->logo1): ?>
    <img class="left" src="<?php echo $this->item->logo1; ?>" height="<?php echo $height; ?>" />
<?php endif; ?>    
<?php if ($this->item->logo2): ?>
    <img class="middle" src="<?php echo $this->item->logo2; ?>" height="<?php echo $height; ?>" />
<?php endif; ?>    
<?php if ($this->item->logo3): ?>
    <img class="right" src="<?php echo $this->item->logo3; ?>" height="<?php echo $height; ?>" />
<?php endif; ?>    
</header>

<section id="internship">

<h1>
<?php if ($this->item->type === "master"): ?>
    Proposition de sujet de master
<?php endif; ?>
    <?php if (!$canEdit): ?>
<?php echo JHtml::_('icon.print_popup',  $this->item, array("type" => "internship")); ?>
<?php endif; ?>
</h1>    

<dl id="host">
<dt><?php if (!$this->item->enterprise_offer): ?>
Intitulé du laboratoire d'accueil
<?php else: ?>
Intitulé de l'entreprise d'accueil
<?php endif; ?>
</dt>

<dd>
    <?php 
    if ($this->item->internal_offer==1) {
         echo "Subatech"; 
    } 
    else {
        echo $this->escape($this->item->host_laboratory_name); 
    }
     ?>
     </dd>
<dt>Adresse</dt>
<dd>
    <?php 
    if ($this->item->internal_offer==1) {
         echo "4 rue Alfred Kastler – BP20722 – 44307 Nantes Cedex"; 
    } 
    else {
        echo $this->escape($this->item->host_laboratory_address); 
    }
    ?>
</dd>

<dt>Nom, prénom et grade du responsable du stage</dt>
<dd><?php echo $this->escape($this->item->contact_name); ?></dd>

<dt>Téléphone</dt>
<dd><?php echo $this->escape($this->item->contact_phone); ?></dd>

<dt>Mél</dt>
<dd><?php echo $this->item->contact_email; ?></dd>

</dl>    
    

<h2><?php echo $this->escape($this->item->title); ?></h2>

<?php echo $this->item->description; ?>

<?php if ($this->item->misc): ?>
<p class="misc">
<?php echo $this->item->misc; ?>
</p>    
<?php endif; ?>

<?php if ($this->item->keywords): ?>
<p class="keywords">
<?php echo $this->escape($this->item->keywords); ?>
</p>    
<?php endif; ?>


</section>

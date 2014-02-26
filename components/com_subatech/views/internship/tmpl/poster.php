<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//$document = JFactory::getDocument();
?>

<header id="logos">
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
<?php if ($this->item->type == "master"): ?>
    Proposition de sujet de master
<?php endif; ?>    
</h1>    

<dl id="host">
<dt><?php if (!$this->item->enterprise_offer): ?>
Intitulé du laboratoire d'accueil
<? else: ?>
Intitulé de l'entreprise d'accueil
<? endif; ?>
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

</div>

        


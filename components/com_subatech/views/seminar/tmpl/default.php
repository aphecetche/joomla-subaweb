<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$params     = $this->item->params;
$params->set('type','seminar');
$canEdit    = $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$document = JFactory::getDocument();
$label = $this->escape($this->item->type);
$layout = new JLayoutFile('one-seminar',null,array('debug'=>false));
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

<section class="seminar-container">

<?php if ($label=="communication-scientifique") { ?>
<h1 class="seminar-type">Colloque café - scientifique</h1>
<h2 class="seminar-byline">Séminaire précédé d'une nouvelle scientifique de Subatech</h2>
<?php if (strlen($this->item->chair)) { ?>
<h2 class="seminar-chair">Animé par <?php echo $this->item->chair; ?></h2>
<?php }; ?>
<h3 class="seminar-date">
  <?php echo JHtml::_('date',$this->item->date,'l j F Y à H:i',true) ; ?>
</h3>
<h4 class="seminar-location">
<?php echo $this->item->location; ?>
</h4>
<?php
$data = (object) array('title' => $this->item->title2,
    'author' => $this->item->author2,
    'author_url' => $this->item->author_url2,
    'author_filiation' => $this->item->author_filiation2,
    'author_filiation_url' => $this->item->author_filiation_url2,
    'summary' => $this->item->summary2,
    'showdate' => false
);
?>
<section class="seminar-main">
<?php echo $layout->render($data); ?>
</section>
<?php
$data = (object) array('title' => $this->item->title,
    'author' => $this->item->author,
    'author_url' => $this->item->author_url,
    'author_filiation' => $this->item->author_filiation,
    'author_filiation_url' => $this->item->author_filiation_url,
    'date' => $this->item->date,
    'summary' => $this->item->summary,
    'showdate' => false,
    'showlocation' => false
);
?>
<p class="seminar-separator">... précédé de ...</p>
<section class="seminar-prelude">
<?php echo $layout->render($data); ?>
</section>
<?php } else {
$data = (object) array('title' => $this->item->title,
    'author' => $this->item->author,
    'author_url' => $this->item->author_url,
    'author_filiation' => $this->item->author_filiation,
    'author_filiation_url' => $this->item->author_filiation_url,
    'date' => $this->item->date,
    'summary' => $this->item->summary,
    'showdate' => false,
    'showlocation' => true
);
?>
<section class="seminar-main">
<h3 class="seminar-date">
  <?php echo JHtml::_('date',$this->item->date,'l j F Y à H:i',true) ; ?>
</h3>
<h4 class="seminar-location">
<?php echo $this->item->location; ?>
</h4>
    <?php echo $layout->render($data); ?>
</section>
<?php } ?>

</section>


<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$style='
span.label-heures-thésards::before {
content: "Heures thésards";
background: #4CAF50;
margin-left: 5px;
padding:3px;
border-radius: 3px;
font-size: 10px;
color:white;
}
span.label-communication-scientifique::before {
content: "Colloque Café - Scientifique";
background: #4CAF50;
margin-left: 5px;
padding:3px;
border-radius: 3px;
font-size: 10px;
color:white;
}
span.label-généraliste::before {
content: "Tout public";
background: #4CAF50;
margin-left: 5px;
padding:3px;
border-radius: 3px;
font-size: 10px;
color:white;
}
span.label-spécialisé::before {
content: "Spécialisé";
background: #ff9800;
margin-left: 5px;
padding:3px;
border-radius: 3px;
font-size: 10px;
color:white;
}
span.label-soutenance-thèse::before {
content: "Soutenance de thèse";
background: #ff9800;
margin-left: 5px;
padding:3px;
border-radius: 3px;
font-size: 10px;
color:white;
}
';

$document->addStyleDeclaration($style);
$now = new DateTime("now");
?>


    <h1><?php echo JText::_('COM_SUBATECH_SEMINAR_LIST_HEADER') . ( $this->year ? ' ('.$this->year.')' : '');?></h1>

    <div class="seminar list">

    <?php foreach ($this->items as $item): ?>

<?php $url = 'index.php?option=com_subatech&view=seminar&id=' . $item->id;
$date = new DateTime($item->date);
$future = (int) ( $date > $now );
?>

    <div class="item">

    <div class="basic">
<?php
$title = $this->escape($item->title);
$type = $this->escape($item->type);
$author = $this->escape($item->author);
$label= '<span class="label-' . $item->type . '"></span>';
if ($type == "communication-scientifique" || $type=="heures-thésards") {
    if (strlen($title) && strlen($item->title2)) {
        $title = $title . "/" . $item->title2;
    } else if (strlen($item->title2)){
        $title = $item->title2;
    }
    if (strlen($author) && strlen($item->author2)) {
        $author = $author . "/" . $item->author2;
    }
    else if (strlen($item->author2)) {
        $author = $item->author2;
    }
};
?>
    <div class="title">
    <a href="<?php echo JRoute::_($url); ?>"><?php echo $title; ?></a>
    <?php echo $label; ?>
</div>
    <div class="author">
    <?php echo $author; ?>
</div>
    </div>

    <div class="venue">
    <div class="date">
    <?php if ( $future > 0 ): ?>
    <?php echo JHtml::_('date',$item->date,'l j F Y'); ?>
<?php else: ?>
    <?php echo JHtml::_('date',$item->date,JText::_('DATE_FORMAT_LC3')); ?>
<?php endif ?>
    </div>
    <?php if ( $this->params->get('show_location',1) == 1 &&  ($future > 0 )): ?>
    <div class="time">
    <?php echo JHtml::_('date',$item->date,'H \h i'); ?>
</div>
    <div class="location"><?php echo $this->escape($item->location) ?></div>
    <?php endif ?>
    </div>

    <div class="actions">
    <?php if ($this->params->get('access-change')): ?>
    <div class="state">
    <?php echo JHtml::_('jgrid.published',$item->state,0,'',false); ?>
</div>
    <?php endif ?>
    <?php if ($this->params->get('access-edit')): ?>
    <div class="edit">
    <?php echo JHtml::_('icon.edit', $item, array("type" => "seminar")); ?>
<?php echo JHtml::_('icon.print_popup',  $item, array("type" => "seminar")); ?>
</div>
    <?php endif; ?>

</div>

    </div>

    <?php endforeach ?>

    </div>

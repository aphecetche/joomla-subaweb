<?php
defined('JPATH_BASE') or die('missing JPATH_BASE');
$date = new DateTime($displayData->date);
$now = new DateTime("now");
$future = ( $date > $now );
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::base() . 'components/com_subatech/layouts/one-seminar.css');
$author= $this->escape($displayData->author);
$author_url= $this->escape($displayData->author_url);
$author_lab_url = $this->escape($displayData->author_filiation_url);
$author_lab = $this->escape($displayData->author_filiation);
?>

<header class="seminar-header">
  <h1>
    <?php echo $this->escape($displayData->title); ?>
  </h1>
  <h2>
<?php if (strlen($author_url)) {
echo '<a href="' . $author_url . '">' . $author . '</a>';
    } else {
        echo $author;
    }
?>
</h2>
    <h3>
<?php if (strlen($author_lab_url)) {
echo '<a href="' . $author_lab_url . '">' . $author_lab . '</a>';
    } else {
        echo $author_lab;
    }
?>
</h3>
    </header>


    <?php if ($displayData->showdate==true) { ?>
    <div class="seminar-date">
    <?php echo JHtml::_('date',$displayData->date,'l j F Y') ; ?>
<?php if ( $future ): ?>
    <?php echo ' @ ' . $date->format('H\hi') ?>
    <?php endif; ?>
</div>
    <?php }; ?>

<?php if ( $future && $displayData->showlocation==true): ?>
    <span class="seminar-location">
    <?php echo $this->escape($displayData->location) ?>
    </span>
    <?php endif; ?>

<div class="seminar-summary">
    <?php echo $displayData->summary ?>
    </div>

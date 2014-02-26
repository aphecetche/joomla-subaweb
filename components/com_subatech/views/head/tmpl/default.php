<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$head = $this->items["head"];
$articles = $this->items["articles"];
?>

<div id="head">
<?php echo $head["introtext"]; ?>	
</div>

<div id="featured">

<ul id="featured-links">
<?php $i=0; foreach ($articles as $a): ?>
<li><a href="#article-<?php echo "$i\">" . $a["title"]; ?></a></li>
<?php $i++; endforeach ?>
</ul>

<div id="featured-content">

<?php $i=0; foreach ($articles as $a): ?>

<div id="article-<?php echo $i; ?>">
	
<h2><?php echo $a["title"]; ?></h2>

<?php echo $a["introtext"]; ?>

</div>

<?php $i++; endforeach ?>
	
</div>
		
</div>


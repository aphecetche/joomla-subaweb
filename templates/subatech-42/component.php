<?php
// No direct access.
defined('_JEXEC') or die;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/subatech-42/css/print.css" type="text/css" media="print,screen,projection" />
</head>
<body class="contentpane">
	<div id="all">
		<div id="topbanner">
		<img src="<?php echo $this->baseurl ?>/templates/subatech-42/images/logo-subatech-for-print.png" width="200px" height="81px" />
		</div>
		<div id="main">
				<jdoc:include type="message" />
				<jdoc:include type="component" />
		</div>
	</div>
</body>
</html>

<?php

  // No direct access.
  defined('_JEXEC') or die('Restricted access');;
  
  jimport('joomla.filesystem.folder');
  
  JHtml::_('behavior.framework', true);
  
  function getBannerImageName() 
  {
    $db =& JFactory::getDBO();
    $thisArticle=JRequest::getInt('id');
    $query = 'SELECT title FROM #__categories WHERE id IN (SELECT catid from #__content WHERE id = ' . $thisArticle . ')';
    $db->setQuery($query, 0, 1);
    $categoryName = $db->loadResult();
    $searchDir = 'images/bandeaux/' . $categoryName;
    if ( JFolder::exists($searchDir) )
    {
      $files=JFolder::files($searchDir,'(.jpg|.JPG|.jpeg|.JPEG)', false, true);
      if ( count($files) > 0 )
      {
        $id = rand(0,count($files)-1);
        return $files[$id];
      }
    }
    
    return 'images/bandeaux/plasma/001.jpg';
    //return 'images/je-suis-charlie.jpg';
  }
  
  
  // Get the user group into $body variable
  $body = '';
  $user = JFactory::getUser();
  $userGroups = $user->getAuthorisedGroups();
  if (count($userGroups))
  {
    rsort($userGroups);
    foreach ( $userGroups as $groupId )
    {
      $db = JFactory::getDBO();
      $query = 'SELECT title FROM #__usergroups WHERE id = ' . $groupId;
      $db->setQuery($query,0,1);
      $groupName = $db->loadResult();
      $body .= 'group-' . $groupName;
      break;
    }
  }
  
  // get the number of "columns" we have to deal with
  $ncols = 1;
  if ( $this->countModules('nav-secondary') ) ++$ncols;
  $colscheme="onecol";
  if ( $ncols == 2 ) $colscheme="twocol";
  
  $registered = ( $user->id ? "registered" : "" );

  $extraJS = "";
  $escriptsrc=array();
  
      // get the headdata
    $headerstuff = $this->getHeadData();
    
    
    $escriptsrc = array_merge($escriptsrc,$headerstuff['scripts']); // retrieve the existing js files
  
    $escriptsrc["http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"] = array( 'mime' => 'text/javascript');  
    
    $escriptsrc["$this->baseurl/templates/subatech-42/js/moosubatech.js"] = array( 'mime' => 'text/javascript');            

    $jsatstart = array();
    
    // hack for jw_allvideos and slimbox that must be loaded in the beginning
    foreach ( $escriptsrc as $src => $a ) {
        if ( strstr($src,'jw_allvideos') ) {
            unset($escriptsrc[$src]);
            $jsatstart[$src] = 1;
        } 
        if ( strstr($src,'google') ) {
            unset($escriptsrc[$src]);
            $jsatstart[$src] = 1;
        }            
    }   

    $escriptsrc["$this->baseurl/templates/subatech-42/js/selectivizr-min.js"] = array( 'mime' => 'text/javascript', 'iecondition' => 'lt IE 9' );



  function generateHead($doc,&$a,&$extraJS)
  {      

        $tab = "";//$doc->_getTab();
        $tagEnd = ' />';

    
      $lnEnd = $doc->_getLineEnd();
        $buffer = '';

        // Generate base tag (need to happen first)
        $base = $doc->getBase();
        if (!empty($base))
        {
            $buffer .= $tab . '<base href="' . $doc->getBase() . '" />' . $lnEnd;
        }

        // Generate META tags (needs to happen as early as possible in the head)
        foreach ($doc->_metaTags as $type => $tag)
        {
            foreach ($tag as $name => $content)
            {
                if ($type == 'http-equiv')
                {
                    $content .= '; charset=' . $doc->getCharset();
                    $buffer .= $tab . '<meta http-equiv="' . $name . '" content="' . htmlspecialchars($content) . '" />' . $lnEnd;
                }
                elseif ($type == 'standard' && !empty($content))
                {
                    $buffer .= $tab . '<meta name="' . $name . '" content="' . htmlspecialchars($content) . '" />' . $lnEnd;
                }
            }
        }

        // Don't add empty descriptions
        $thisDescription = $doc->getDescription();
        if ($thisDescription)
        {
            $buffer .= $tab . '<meta name="description" content="' . htmlspecialchars($thisDescription) . '" />' . $lnEnd;
        }


        $buffer .= $tab . '<title>' . htmlspecialchars($doc->getTitle(), ENT_COMPAT, 'UTF-8') . '</title>' . $lnEnd;


        // Generate link declarations
        foreach ($doc->_links as $link => $linkAtrr)
        {
            $buffer .= $tab . '<link href="' . $link . '" ' . $linkAtrr['relType'] . '="' . $linkAtrr['relation'] . '"';
            if ($temp = JArrayHelper::toString($linkAtrr['attribs']))
            {
                $buffer .= ' ' . $temp;
            }
            $buffer .= ' />' . $lnEnd;
        }

        // Generate stylesheet links
        foreach ($doc->_styleSheets as $strSrc => $strAttr)
        {
            $buffer .= $tab . '<link rel="stylesheet" href="' . $strSrc . '" type="' . $strAttr['mime'] . '"';
            if (!is_null($strAttr['media']))
            {
                $buffer .= ' media="' . $strAttr['media'] . '" ';
            }
            if ($temp = JArrayHelper::toString($strAttr['attribs']))
            {
                $buffer .= ' ' . $temp;
            }
            $buffer .= $tagEnd . $lnEnd;
        }

        // Generate stylesheet declarations
        foreach ($doc->_style as $type => $content)
        {
            $buffer .= $tab . '<style type="' . $type . '">' . $lnEnd;

            // This is for full XHTML support.
            if ($doc->_mime != 'text/html')
            {
                $buffer .= $tab . $tab . '<![CDATA[' . $lnEnd;
            }

            $buffer .= $content . $lnEnd;

            // See above note
            if ($doc->_mime != 'text/html')
            {
                $buffer .= $tab . $tab . ']]>' . $lnEnd;
            }
            $buffer .= $tab . '</style>' . $lnEnd;
        }

        // Generate script declarations
        /*
        foreach ($doc->_script as $type => $content)
        {
            $buffer .= $tab . '<script type="' . $type . '">' . $lnEnd;

            // This is for full XHTML support.
            if ($doc->_mime != 'text/html')
            {
                $buffer .= $tab . $tab . '<![CDATA[' . $lnEnd;
            }

            $buffer .= $content . $lnEnd;

            // See above note
            if ($doc->_mime != 'text/html')
            {
                $buffer .= $tab . $tab . ']]>' . $lnEnd;
            }
            $buffer .= $tab . '</script>' . $lnEnd;
        }
        */
        
        $extra = '';
        // Generate script language declarations.
        if (count(JText::script()))
        {
            $extra .= $tab . '<script type="text/javascript">' . $lnEnd;
            $extra .= $tab . $tab . '(function() {' . $lnEnd;
            $extra .= $tab . $tab . $tab . 'var strings = ' . json_encode(JText::script()) . ';' . $lnEnd;
            $extra .= $tab . $tab . $tab . 'if (typeof Joomla == \'undefined\') {' . $lnEnd;
            $extra .= $tab . $tab . $tab . $tab . 'Joomla = {};' . $lnEnd;
            $extra .= $tab . $tab . $tab . $tab . 'Joomla.JText = strings;' . $lnEnd;
            $extra .= $tab . $tab . $tab . '}' . $lnEnd;
            $extra .= $tab . $tab . $tab . 'else {' . $lnEnd;
            $extra .= $tab . $tab . $tab . $tab . 'Joomla.JText.load(strings);' . $lnEnd;
            $extra .= $tab . $tab . $tab . '}' . $lnEnd;
            $extra .= $tab . $tab . '})();' . $lnEnd;
            $extra .= $tab . '</script>' . $lnEnd;
        }

        $buffer .= $extra;
         
        $customBuffer = '';


        foreach ($doc->_custom as $custom)
        {

            $lines = explode("\n",$custom);
            $begin=false;
            $s="";
            
            foreach ($lines as $l) {

                if ($begin)
                {
                    if ( strstr("$l","/script") )
                    {
                        $begin = false;
                        $extraJS .= $s;                     
                    }
                    else { $s .= $l;}
                    
                }
                if (strstr("$l","text/javascript") ) {
                    if ( strstr("$l","script") && strstr("$l","/script") )
                    {                     
                        $i=stripos($l,"src=");                    
                        $s = substr($l,$i+5);
                        $i=stripos($s,'"');
                        $s = substr($s,0,$i);                        
                        $a["$s"] = array();
                    }
                    else 
	                {
	                   // that is the start of several lines of JS
	                   $begin=true;
	                   $s="";
//	                   JFactory::getApplication()->enqueueMessage(htmlspecialchars("L=$l"));
	                }
                }
                else                
                  {
                   if (!$begin) { echo "$l\n"; }
                }
            }
                 
        }
        
        return $buffer;      
  }


?>
<!doctype html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>

<!-- http://t.co/dKP3o1e -->
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->baseurl ?>/templates/subatech-42/images/ios/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->baseurl ?>/templates/subatech-42/images/ios/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $this->baseurl ?>/templates/subatech-42/images/l/apple-touch-icon-57x57.png">
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/subatech-42/images/ios/apple-touch-icon-57x57.png">
<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/subatech-42/favicon.ico">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="apple-touch-startup-image" href="<?php echo $this->baseurl ?>/templates/subatech-42/images/ios/splash.png">

<?php 
if ( $registered ) { 
    echo '<jdoc:include type="head" />';
} 
else {
    foreach ( $jsatstart as $src => $a ) {
        echo "<script src=\"$src\" type=\"text/javascript\"></script>\n";
    }   
    

    echo generateHead($this,$escriptsrc,$extraJS);

} 
?> 

<link href="<?php echo $this->baseurl ?>/templates/subatech-42/css/basic.css" rel="stylesheet" type="text/css" >

<?php if ( ! $registered) : ?>
<!-- EnhanceJS from Designing With Progressive Enhancement book-->
<script src="<?php echo $this->baseurl ?>/templates/subatech-42/js/enhance.js" type="text/javascript"></script>
 
<script type="text/javascript">
enhance(
        {
        loadStyles: [
          "<?php echo $this->baseurl ?>/templates/subatech-42/css/enhanced.css"
        ],
        loadScripts: [
            <?php
              $l = count($escriptsrc);
              $n=0;
              foreach($escriptsrc as $key => $script) {
                echo "{ src: \"$key\" ";
                foreach($script as $k => $v ) {
                    if ($v) { echo ", \"$k\": \"$v\""; }
                }
                echo "}";
                $n++;
                if ($n < $l) {
                    echo ",";
                }
                echo "\n";
            }
            ?>
        ],
        forceFailText: "<?php echo JText::_('TPL_SUBATECH_42_BASIC_VERSION') ?>",
        forcePassText: "<?php echo JText::_('TPL_SUBATECH_42_ENHANCED_VERSION') ?>",
        onScriptsLoaded: function() {
            <?php
            foreach ($this->_script as $type => $content)
            {
                echo $content;
            }
            echo $extraJS;
            
            ?>
        }
        });
        
</script>

<?php else: ?>
    
<link href="<?php echo $this->baseurl ?>/templates/subatech-42/css/enhanced.css" rel="stylesheet" type="text/css" >
<script src="<?php echo $this->baseurl ?>/templates/subatech-42/js/moosubatech.js" type="text/javascript"></script>

<script src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML" type="text/javascript"></script>

<script src="<?php echo $this->baseurl ?>/templates/subatech-42/js/zslimbox.js" type="text/javascript" mime="text/javascript"></script>

<?php endif; ?>

<!--[if (lt IE 9)]>
<script type="text/javascript">
document.createElement('header');
document.createElement('footer');
document.createElement('section');
document.createElement('aside');
document.createElement('nav');
document.createElement('article');
document.createElement('hgroup');
</script>
<link href="<?php echo $this->baseurl ?>/templates/subatech-42/css/ie.css" rel="stylesheet" type="text/css" >
<![endif]-->

       
</head>

<body class="clearfix <?php echo $body. ' ' . $colscheme . ' ' . $registered; ?> regularnav" >

<div class="skipLink">
<ul>
<li><a href="#content"><?php echo JText::_('TPL_SUBATECH_42_SKIPTOCONTENT'); ?></a></li>
<li><a href="#footer"><?php echo JText::_('TPL_SUBATECH_42_SKIPTOFOOTER'); ?></a></li>
</ul>
</div>

<!-- using ie6countdown to inform we are clearly not supporting IE<=6 -->
<!--[if lt IE 7]> <div style=' clear: both; height: 59px; padding:0 0 0 15px; position: relative;'> <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0024_french.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a></div> <![endif]-->

<header role="banner" class="clearfix">
<a id="logo" href="<?php echo $this->baseurl ?>"><h1>Laboratoire de physique subatomique et des technologies associées</h1></a>
</header>

<?php if ($this->countModules('nav-primary')): ?>
<nav id="nav-primary" role="navigation">
<jdoc:include type="modules" name="nav-primary" />
</nav>
<?php endif; ?>

<div id="bannerimage" title="<?php echo $this->baseurl.'/'.getBannerImageName(); ?>">                                    
</div>

<div id="newsline">
<jdoc:include type="modules" name="newsline" />
</div>

<?php if ($this->countModules('nav-authors')): ?>
<nav id="nav-authors" role="navigation">
<jdoc:include type="modules" name="nav-authors" />
</nav>
<?php endif; ?>

<?php if ($this->countModules('nav-breadcrumbs')): ?>
<nav id="nav-breadcrumbs" role="navigation">
<jdoc:include type="modules" name="nav-breadcrumbs" />
</nav>
<?php endif; ?>

<div id="wrapper" class="clearfix">

<?php if ($this->countModules('nav-secondary')): ?>
<nav id="nav-secondary" role="navigation" class="column">
<jdoc:include type="modules" name="nav-secondary" /> 
</nav>
<?php endif; ?>

<section role="main" id="content" class="column">
<jdoc:include type="message" />
<jdoc:include type="component" />
</section>

<!-- FIXME : typical usage for this ? -->
<?php if ($this->countModules('complementary')): ?>
<aside id="complementary" role="complementary" class="column">
<jdoc:include type="modules" name="complementary" />
</aside>
<?php endif; ?>


</div> <!--end of wrapper div for content + secondary nav + complementary -->

<footer role="contentinfo" class="clearfix" id="footer">

<?php if ($this->countModules('nav-footer')): ?>
<nav id="nav-footer">
<jdoc:include type="modules" name="nav-footer" />
</nav>
<?php endif; ?>

<?php if ($this->countModules('search')): ?>
<div id="search" role="search">
<jdoc:include type="modules" name="search" />
</div>
<?php endif; ?>

</footer>

<div id="endnote">
<jdoc:include type="modules" name="endnote" />
</div>

</body>
</html>

<?php

kirbytext::$tags['desktoptext'] = array(
'attr' => array(
	'desktoptext'
  ),
  'html' => function($tag) {
  	$text = $tag->attr('desktoptext');
    return '<span class="lg-only">' . $text . '</span>';
  }
);
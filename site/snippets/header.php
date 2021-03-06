<!-- Design by VLF and Development by Tristan Bagot -->

<?php $pname = $page->content()->name() ?>
<?php $template = $page->pagetemplate() ?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php elseif($pname == "project" || $pname == "projectvideo"): ?>
		<title><?= $page->title()->html() ?> | <?= $page->parent()->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<meta name="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if(!$page->text()->empty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php elseif($pname == "project" || $pname == "projectvideo"): ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $page->parent()->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $page->parent()->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if ($page->featuredimage()->isNotEmpty()): ?>
		<meta property="og:image" content="<?= resizeOnDemand($page->image($page->featuredimage()), 1200) ?>"/>
	<?php else: ?>
		<?php if($site->ogimage()->isNotEmpty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
	<?php endif ?>

	<meta itemprop="description" content="<?= $site->description()->html() ?>">

	<?php 
	echo css('assets/css/build/build.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>

<body class="<?php if($page->isHomepage()) { echo 'home'; } elseif($pname == 'artist'){ echo ' artist'; } elseif($pname == 'artists') { echo ' page'; } elseif($pname == 'project' || $pname == 'projectvideo') { echo ' project slider-mode'; } elseif($pname == 'category') { echo ' category slider-mode'; } elseif($pname == 'default') { echo ' page footer'; } if($pname == 'projectvideo') { echo ' black-mode';} if ( $template == "portfolio") { echo ' portfolio-mode'; }?>" data-id="<?= tagslug($page->uid()) ?>">

<div id="loader"></div>

<header class="fixed">
	<?php $items = $pages->visible(); ?>
	<?php if($items->count()): ?>
	<nav id="menu">
		<ul>
			<li id="site-title">
				<a href="<?= $site->url() ?>" data-target="index"><?= $site->title()->html() ?></a>
			</li>
			<?php foreach($items as $item): ?>
				<li><a href="<?php echo $item->url() ?>" data-title="<?= $item->title()->html() ?>" data-id="<?= tagslug($item->title()) ?>" data-target="page"><?php echo $item->title()->html() ?></a></li>
			<?php endforeach ?>
		</ul>
	</nav>
	<?php endif ?>
	<div id="page-title">
		<span><?= $page->title()->html() ?></span>
	</div>
	<div id="ticker" class="bar" data-tick="<?php e($pname == 'artist', $site->title()->html(), $page->title()->html()) ?>">
		<div id="ticker-inner"></div>
	</div>
</header>

<div id="container">
<?php snippet('header') ?>

<?php $news = $page->globalorder()->toStructure()->flip() ?>

<div id="news" class="content-grid">

<?php foreach ($news as $key => $entry): ?>

	<?php $project = page($entry->project()->value());
		  $image = $project->image($project->featuredimage());
	      $artist = $project->parent();
	      $gridwidth = $entry->gridwidth()->value();
	      $gridoffset = $entry->gridoffset()->value();
	      $project->content()->name() == "projectvideo" ? $videoproject = true : $videoproject = false;
	?>
	<?php if($image): ?>

	<div class="project<?php if($videoproject){echo ' video';} ?> column col-<?= $gridwidth ?> <?php if($gridoffset != '0'){ echo 'off-'.$gridoffset; } ?>">
		<a href="<?php if($artist->pagetemplate() == "portfolio") { echo $artist->url(); } else { echo $project->url(); } ?>" 
		data-artist="<?= $artist->title()->html() ?>" 
		data-title="<?= $project->title()->html() ?>" 
		data-hover-title="<?= $artist->title()->html().' '.$project->title()->html() ?>" 
		data-hover-id="<?= tagslug($project->title()) ?>" 
		data-target="project">
			<?php 
				$srcset = '';
				for ($i = 500; $i <= 2500; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
			?>
			<img 
			src="<?= resizeOnDemand($image, 50) ?>" 
			data-src="<?= resizeOnDemand($image, 1000) ?>" 
			data-srcset="<?= $srcset ?>" 
			data-sizes="auto" 
			data-optimumx="1.5" 
			class="lazyimg lazyload" 
			alt="<?= $project->title()->html().' — © '.$artist->title()->html(); ?>" 
			width="100%" height="auto">
		<?php if($videoproject): ?>
			<video autobuffer loop muted poster="<?= resizeOnDemand($image, 1000) ?>" width="100%" height="100%">
			  <source src="<?= $project->videofile()->toFile()->url() ?>" type="video/mp4">
			  Your browser does not support the video tag.
			</video>
		<?php endif ?>
		</a>
	</div>

	<?php endif ?>

<?php endforeach ?>

</div>

<?php snippet('footer') ?>
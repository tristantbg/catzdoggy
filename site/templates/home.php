<?php snippet('header') ?>

<?php $news = $page->globalorder()->toStructure() ?>

<div id="news" class="content-grid">

<?php foreach ($news as $key => $entry): ?>

	<?php $project = page($entry->project()->value());
		  $image = $project->image($project->featuredimage());
	      $artist = $project->parent()->parent();
	      $gridwidth = $entry->gridwidth()->value();
	      $gridoffset = $entry->gridoffset()->value();
	?>
	<?php if($image): ?>

	<div class="project column col<?= $gridwidth ?> off<?= $gridoffset ?>">
		<a href="<?= $project->url() ?>"
		data-title="<?= $project->title()->html() ?>" 
		data-hover-title="<?= $project->parent()->parent()->title()->html().' '.$project->title()->html() ?>" 
		data-hover-id="<?= tagslug($project->title()) ?>" 
		data-target="artist">
		<?php 
			$srcset = '';
			for ($i = 500; $i <= 2500; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
		?>

			<img 
			src="<?= resizeOnDemand($image, 50) ?>" 
			srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
			data-src="<?= resizeOnDemand($image, 1000) ?>" 
			data-srcset="<?= $srcset ?>" 
			data-sizes="auto" 
			data-optimumx="1.5" 
			class="lazyimg lazyload" 
			alt="<?= $project->title()->html().' — © '.$artist->title()->html(); ?>" 
			width="100%" height="auto">
		</a>
	</div>

	<?php endif ?>

<?php endforeach ?>

</div>

<?php snippet('footer') ?>
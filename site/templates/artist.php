<?php snippet('header') ?>

<?php $categories = $page->children()->visible() ?>
<?php $projects = $page->grandChildren()->visible()->sortBy('id', 'asc') ?>
<?php $row = 0 ?>

<div id="artist-projects" class="content-grid">

<?php foreach ($projects as $key => $project): ?>

	<?php $image = $project->image($project->featuredimage());
	      $artist = $project->parent()->parent();
	      $gridwidth = $project->gridwidth()->value();
	      $gridoffset = $project->gridoffset()->value();
	?>
	<?php if($image): ?>

	<div class="project column col<?= $gridwidth ?> off<?= $gridoffset ?>">
		<a href="<?= $project->url() ?>"
		data-title="<?= $project->title()->html() ?>" 
		data-hover-title="<?= $project->title()->html() ?>" 
		data-hover-id="<?= tagslug($project->title()) ?>" 
		data-filter="<?= tagslug($project->parent()->title()) ?>" 
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

<div id="categories">
	
		<span class="category">
			<a class="active" data-filter="all">All</a>
		</span>
	<?php foreach ($categories as $key => $cat): ?>
		<span class="category">
			<a data-filter="<?= tagslug($cat->title()) ?>"><?= $cat->title()->html() ?></a>
		</span>
	<?php endforeach ?>
		<span class="clients-link">
			<a data-target="clients">Clients</a>
		</span>
	
</div>

<?php snippet('footer') ?>
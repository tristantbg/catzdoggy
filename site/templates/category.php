<?php snippet('header') ?>

<?php $artist = $page->parent() ?>
<?php $projects = $page->children()->visible()->sortBy('globalid', 'asc') ?>

<div id="artist-slider" class="slider-container">
	
	<div id="top-bar" class="bar">
		<div id="switch" class="to-black"></div>
		<div id="artist-title">
			<a href="<?= $artist->url() ?>" data-title="<?= $artist->title()->html() ?>" data-target="artist">
			<?= $artist->title()->html() ?>
			</a>
		</div>
		<div id="close" href="<?= $artist->url() ?>" data-title="<?= $artist->title()->html() ?>" data-target="artist">
			<a href="<?= $artist->url() ?>" data-title="<?= $artist->title()->html() ?>" data-target="artist">
				<span></span>
				<span></span>
			</a>
		</div>
	</div>
	
	<div class="slider">

	<?php foreach ($projects as $index => $project): ?>
	<?php $gallery = $project->gallery()->yaml() ?>

		<?php foreach ($gallery as $key => $image): ?>

			<?php $image = $project->image($image); ?>

			<div class="cell" data-id="<?= $key+1 ?>" data-project-title="<?= $project->title()->html() ?>">
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
					class="content lazyimg<?php e($key == 0, ' lazyload', '') ?>" 
					alt="<?= $project->title()->html().' — © '.$artist->title()->html(); ?>" 
					width="auto" height="100%">

					<noscript>
						<img class="content" alt="<?= $project->title()->html().' — © '.$artist->title()->html(); ?>" src="<?php echo resizeOnDemand($image, 1500) ?>" height="100%" width="auto" />
					</noscript>
			</div>

		<?php endforeach ?>

	<?php endforeach ?>

	</div>

	<div id="bottom-bar" class="bar">
	<?php if($projects->count() > 0): ?>
		<?= $projects->first()->title()->html() ?>
	<?php endif ?>
	</div>

</div>

<?php snippet('footer') ?>
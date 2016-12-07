<?php snippet('header') ?>

<?php $artist = $page->parent()->parent() ?>
<?php $gallery = $page->gallery()->yaml() ?>

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

		<?php foreach ($gallery as $key => $image): ?>

			<?php $image = $page->image($image); ?>

			<div class="cell" data-slide-id="<?= $key+1 ?>">
				<?php 
					$srcset = '';
					for ($i = 500; $i <= 2500; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
				?>

					<img 
					srcset="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" 
					data-src="<?= resizeOnDemand($image, 1000) ?>" 
					data-srcset="<?= $srcset ?>" 
					data-sizes="auto" 
					data-optimumx="1.5" 
					class="content lazyimg<?php e($key == 0, ' lazyload', '') ?>" 
					alt="<?= $page->title()->html().' — © '.$artist->title()->html(); ?>" 
					width="auto" height="100%">

					<noscript>
						<img class="content" alt="<?= $page->title()->html().' — © '.$artist->title()->html(); ?>" src="<?php echo resizeOnDemand($image, 1500) ?>" height="100%" width="auto" />
					</noscript>
			</div>

		<?php endforeach ?>

	</div>

	<div class="bottom bar">
		<?= $page->title()->html() ?>
	</div>

</div>

<?php snippet('footer') ?>
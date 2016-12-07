<?php snippet('header') ?>

<?php $artists = $page->children()->visible() ?>

<div id="artists-menu" class="bar">
	
	<?php foreach ($artists as $key => $artist): ?>
		<span class="artist-link">
			<a href="<?= $artist->url() ?>" data-title="<?= $artist->title()->html() ?>" data-hover-id="<?= tagslug($artist->title()) ?>" data-target="artist">
			<?= $artist->title()->html() ?>
			</a>
		</span>
	<?php endforeach ?>
	
</div>

<div id="artists-list">

<?php foreach ($artists as $key => $artist): ?>
	<?php $featured = $artist->image($artist->featuredimage()) ?>

	<div class="artist fat border">
		<a href="<?= $artist->url() ?>" data-title="<?= $artist->title()->html() ?>" 
		data-hover-id="<?= tagslug($artist->title()) ?>" 
		<?php if ($featured): ?>
		data-hover-image="<?= resizeOnDemand($featured, 500) ?>"
		<?php endif ?>
		data-target="artist">
		<?= $artist->title()->html() ?>
		</a>
	</div>

<?php endforeach ?>

<img id="image-hover" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">

</div>

<?php snippet('footer') ?>
<?php snippet('header') ?>

<?php $artist = $page->parent() ?>
<?php $gallery = $page->gallery()->yaml() ?>

<div id="artist-slider" class="slider-container">
	
	<div id="top-bar" class="bar">
		<div id="switch" class="to-white"></div>
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
	
	<div class="video">

		<div class="cell">

				<?php 
				$url = $page->videourl();
				$headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $url);
				if(is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false) {
        // is youtube
					$videoID = $url;
					echo '<div class="js-player" data-type="youtube" data-video-id="' . $videoID  . '"></div>';
				} else {
        // should be vimeo
					$videoID = $url;
					echo '<div class="js-player" data-type="vimeo" data-video-id="' . $videoID  . '"></div>';
				}

				?>
		 </div>

	</div>

	<div id="bottom-bar" class="bar">
		<?= $page->title()->html() ?>
	</div>

</div>

<?php snippet('footer') ?>
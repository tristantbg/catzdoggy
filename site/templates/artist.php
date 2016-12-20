<?php snippet('header') ?>

<?php $artist = $page; ?>
<?php $projects = $page->children()->visible() ?>
<?php $template = $page->pagetemplate() ?>

<?php if($template == 'portfolio'): ?>

	<div id="artist-projects" class="content-grid">
		
		<?php $idx = 0 ?>
		<?php foreach ($projects as $key => $project): ?>

			<?php $image = $project->image($project->featuredimage());
			      $gridwidth = $project->gridwidth()->value();
			      $gridoffset = $project->gridoffset()->value();
			?>
			<?php if($image): ?>
			<?php $idx++ ?>
			<div class="project column col-<?= $gridwidth ?> <?php if($gridoffset != '0'){ echo 'off-'.$gridoffset; } ?>">
				<a href="<?= $project->url() ?>" 
				data-artist="<?= $artist->title()->html() ?>" 
				data-title="<?= $project->title()->html() ?>" 
				data-hover-title="<?= $project->title()->html() ?>" 
				data-slide="<?= $idx ?>" 
				data-target="slide">
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
				</a>
			</div>

			<?php endif ?>

		<?php endforeach ?>

		</div>

		<div id="categories" class="bar">
			
				<span class="category">
					<a class="active" data-filter="all" data-target="slide" data-all>Work</a>
				</span>
				<span class="clients-link">
					<a data-target="clients">Clients</a>
				</span>
			
		</div>

		<div id="artist-clients">

		<?php foreach ($page->clients()->toStructure() as $key => $client): ?>

			<div class="client fat" 
				data-tick="<?= $client->client()->html() ?>" 
				<?php if ($client->clientimage()->isNotEmpty()): ?>
				data-hover-image="<?= resizeOnDemand($client->clientimage()->toFile(), 500) ?>"
				<?php endif ?>
				><?= $client->client()->html() ?></div>

		<?php endforeach ?>
		
		<img id="image-hover" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">

		</div>

		<div id="artist-slider" class="slider-container">
	
			<div id="top-bar" class="bar">
				<div id="switch" class="to-black"></div>
				<div id="artist-title">
					<a href="<?= $page->url() ?>" data-title="<?= $page->title()->html() ?>" data-target="artist">
					<?= $page->title()->html() ?>
					</a>
				</div>
				<div id="close" href="<?= $page->url() ?>" data-target="sliderclose">
					<span></span>
					<span></span>
				</div>
			</div>
			
			<div class="slider">
			
			<?php $idx = 0 ?>
			<?php foreach ($projects as $index => $project): ?>

				<?php 
				$image = $project->image($project->featuredimage());
				$artist = $project->parent()->parent();
				?>
				<?php if($image): ?>
				<?php $idx++ ?>

				<div class="cell" data-slide-id="<?= $idx ?>" data-project-title="<?= $project->title()->html() ?>">
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
						alt="<?= $project->title()->html().' — © '.$artist->title()->html(); ?>" 
						width="auto" height="100%">

						<noscript>
							<img class="content" alt="<?= $project->title()->html().' — © '.$artist->title()->html(); ?>" src="<?php echo resizeOnDemand($image, 1500) ?>" height="100%" width="auto" />
						</noscript>
				</div>

				<?php endif ?>

			<?php endforeach ?>

			</div>

			<div id="bottom-bar" class="bar">
			<?php if($projects->count() > 0): ?>
				<?= $projects->first()->title()->html() ?>
			<?php endif ?>
			</div>

	</div>

<?php else: ?>

		<div id="artist-projects" class="content-grid">

		<?php foreach ($projects as $key => $project): ?>

			<?php $image = $project->image($project->featuredimage());
			      $artist = $project->parent()->parent();
			      $gridwidth = $project->gridwidth()->value();
			      $gridoffset = $project->gridoffset()->value();
			      $project->content()->name() == "projectvideo" ? $videoproject = true : $videoproject = false;
			?>
			<?php if($image): ?>

			<div class="project<?php if($videoproject){echo ' video';} ?> column col-<?= $gridwidth ?> <?php if($gridoffset != '0'){ echo 'off-'.$gridoffset; } ?>">
				<a href="<?= $project->url() ?>"
				data-artist="<?= $artist->title()->html() ?>" 
				data-title="<?= $project->title()->html() ?>" 
				data-hover-title="<?= $project->title()->html() ?>" 
				data-hover-id="<?= tagslug($project->title()) ?>" 
				data-filter="<?= tagslug($project->parent()->title()) ?>" 
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

		<div id="categories" class="bar">
			
				<span class="category">
					<a class="active" data-filter="all" data-all>Work</a>
				</span>
				<span class="clients-link">
					<a data-target="clients">Clients</a>
				</span>
			
		</div>

		<div id="artist-clients">

		<?php foreach ($page->clients()->toStructure() as $key => $client): ?>

			<div class="client fat" 
				data-tick="<?= $client->client()->html() ?>" 
				<?php if ($client->clientimage()->isNotEmpty()): ?>
				data-hover-image="<?= resizeOnDemand($client->clientimage()->toFile(), 1000) ?>"
				<?php endif ?>
				><?= $client->client()->html() ?></div>

		<?php endforeach ?>
		
		<img id="image-hover" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">

		</div>

<?php endif ?>

<?php snippet('footer') ?>
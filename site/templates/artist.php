<?php snippet('header') ?>

<?php $categories = $page->children()->visible() ?>
<?php $projects = $page->grandChildren()->visible()->sortBy('globalid', 'asc') ?>
<?php $template = $page->pagetemplate() ?>

<?php if($template == 'categories'): ?>

	<div id="artist-projects" class="categories-grid">

		<?php foreach ($categories as $key => $cat): ?>

			<?php $image = $cat->image($cat->featuredimage());
				  $artist = $cat->parent();
			?>
			<?php if($image): ?>

			<div class="category-thumbnail">
				<a href="<?= $cat->url() ?>"
				data-title="<?= $cat->title()->html() ?>" 
				data-target="category">

					<img 
					src="<?= thumb($image, array('width' => 800, 'height' => 1040, 'crop' => true, 'quality' => 90))->url() ?>" 
					alt="<?= $cat->title()->html().' — © '.$artist->title()->html(); ?>" 
					width="100%" height="auto">
				</a>
				<div class="category-title">
					<?= $cat->title()->html() ?>
				</div>
			</div>

			<?php endif ?>

		<?php endforeach ?>

	</div>

<?php elseif($template == 'portfolio'): ?>

	<div id="artist-projects" class="content-grid">
		
		<?php $idx = 0 ?>
		<?php foreach ($projects as $key => $project): ?>

			<?php $image = $project->image($project->featuredimage());
			      $artist = $project->parent()->parent();
			      $gridwidth = $project->gridwidth()->value();
			      $gridoffset = $project->gridoffset()->value();
			?>
			<?php if($image): ?>
			<?php $idx++ ?>
			<div class="project column col<?= $gridwidth ?> off<?= $gridoffset ?>">
				<a href="<?= $project->url() ?>"
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

		<div id="categories" class="bar">
			
				<span class="category">
					<a class="active" data-filter="all" data-target="slide" data-all>All</a>
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
			?>
			<?php if($image): ?>

			<div class="project column col<?= $gridwidth ?> off<?= $gridoffset ?>">
				<a href="<?= $project->url() ?>"
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

		<div id="categories" class="bar">
			
				<span class="category">
					<a class="active" data-filter="all" data-all>All</a>
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

<?php endif ?>

<?php snippet('footer') ?>
<?php snippet('header') ?>

<?php $categories = $page->children()->visible() ?>
<?php $projects = $page->grandChildren()->visible()->sortBy('id', 'asc') ?>
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
<?php $index = 0 ?>

	<div id="artist-projects" class="content-grid">

		<?php foreach ($projects as $key => $project): ?>

			<?php 
				$gallery = $project->gallery()->yaml();
				if (count($gallery) > 0) {
					$image = $project->image($gallery[0]);
					$index++;
				} else {
					$image = null;
				}
				$artist = $project->parent()->parent();
				$gridwidth = $project->gridwidth()->value();
				$gridoffset = $project->gridoffset()->value();
			?>
			<?php if($image): ?>

			<div class="project column col<?= $gridwidth ?> off<?= $gridoffset ?>">
				<?= $index ?>
				<a href="<?= $project->url() ?>"
				data-title="<?= $project->title()->html() ?>" 
				data-hover-title="<?= $project->title()->html() ?>" 
				data-slide="<?= $index ?>" 
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
			
			<?php
			foreach ($gallery as $k => $image){
				if ($k > 0) {
					$index++;
				}
			}
			?>

			<?php endif ?>

		<?php endforeach ?>

		</div>

		<div id="categories" class="bar">
			
				<span class="category">
					<a class="active" data-filter="all">All</a>
				</span>
				<span class="clients-link">
					<a data-target="clients">Clients</a>
				</span>
			
		</div>

		<div id="artist-slider" class="slider-container">
	
			<div id="top-bar" class="bar">
				<div id="switch" class="to-black"></div>
				<div id="artist-title">
					<a href="<?= $artist->url() ?>" data-title="<?= $artist->title()->html() ?>" data-target="artist">
					<?= $artist->title()->html() ?>
					</a>
				</div>
				<div id="close" href="<?= $artist->url() ?>" data-target="sliderclose">
					<a href="<?= $artist->url() ?>" data-target="sliderclose">
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

<?php endif ?>

<?php snippet('footer') ?>
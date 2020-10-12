
					<div class="col-6 col-sm">
						<div class="card-news">
							<a href="<?php the_permalink() ?>" class="card-img">
								<?php the_post_thumbnail(); ?>
							</a>
							<h2 class="card-title">
								<a href="<?php the_permalink() ?>">
									<?php the_title(); ?>
								</a>
							</h2>
							<span class="card-date">
								<?php echo get_the_date(); ?>
							</span>
						</div>
					</div>
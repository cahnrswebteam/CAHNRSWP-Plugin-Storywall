<?php get_header(); ?>

<main class="spine-category-index">

<?php get_template_part('parts/headers'); ?>

	<section class="row single gutter">

		<div class="column one story-wall">

			<header class="archive-header">
				<h1 class="archive-title"><?php esc_html( single_cat_title( '', true ) ); ?></h1>
			</header>

			<?php if ( category_description() ) : ?>
			<div class="category-description">
				<?php echo wp_kses_post( category_description() ); ?>
      </div>
			<?php endif; ?>


			<?php
      	global $query_string;
				query_posts( $query_string . "&posts_per_page=100" );
				
				$i = 0;
				
				$background_colors = array( 'crimson', 'green', 'orange', 'blue', 'yellow', 'gray' );
			?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					$classes = array();
					$i++;
					if ( 1 === $i || 6 === $i ) {
						$classes[] = 'tier-one';
						$placeholder = array( 'tier1', '450', '640' );
					} elseif ( 2 === $i || 5 === $i || 7 === $i || 10 === $i ) {
						$classes[] = 'tier-two';
						$placeholder = array( 'tier2', '450', '320' );
					} elseif ( 3 === $i || 4 === $i || 8 === $i || 9 === $i ) {
						$classes[] = 'tier-three';
						$placeholder = array( 'tier3', '225', '320' );
					}

					// Flip 'odd' rows.
					if ( 6 === $i || 7 === $i || 8 === $i || 9 === $i || 10 === $i ) {
						$classes[] = 'flipped';
					}

					// Reset the counter.
					if ( 10 === $i ) {
						$i = 0;
					}
					
					$random_bg = array_rand( $background_colors, 1 );
					$classes[] = $background_colors[$random_bg];

					if ( has_post_thumbnail() ) {
						$classes[] = 'has-featured-image';
					}
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

					<img src="<?php echo plugin_dir_url( dirname(__FILE__) ) . 'images/' . esc_attr( $placeholder[0] ); ?>.png" width="<?php echo esc_attr( $placeholder[1] ); ?>" height="<?php echo esc_attr( $placeholder[2] ); ?>" />

					<?php
						if ( has_post_thumbnail() ) {
							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'spine-medium_size' );
							$background = ' style="';
							$background .= 'background-image: url(' . esc_url( $featured_image[0] ) . ');';
							if ( ( 'tier1' === $placeholder[0] || 'tier3' === $placeholder[0] ) && get_post_meta( $post->ID, 'storywall_background_position', true ) ) {
								$background .= ' background-position: ' . esc_attr( get_post_meta( $post->ID, 'storywall_background_position', true ) ) . ';';
							}
							if ( 'tier2' === $placeholder[0] && get_post_meta( $post->ID, 'storywall_tier2_background_position', true ) ) {
								$background .= ' background-position: ' . esc_attr( get_post_meta( $post->ID, 'storywall_tier2_background_position', true ) ) . ';';
							}
							$background .= '"';
						} else {
							$background = '';
						}
					?>

					<div<?php echo $background; ?>>

						<div>

							<header class="article-header">
								<hgroup>
									<h2 class="article-title">
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                  </h2>
								</hgroup>
							</header>

							<div class="article-summary">
								<p><?php echo get_the_excerpt(); ?></p>
            		<p class="more-button"><a href="<?php the_permalink(); ?>" rel="bookmark">Read more</a></p>
							</div><!-- .article-summary -->

						</div>

						<a href="<?php the_permalink(); ?>"></a>

					</div>

				</article>

			<?php endwhile; // end of the loop. ?>

		</div><!--/column-->

	</section>

</main>

<?php get_footer(); ?>
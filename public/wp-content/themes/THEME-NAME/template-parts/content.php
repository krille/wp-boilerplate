<?php
/**
 * Template part for displaying posts
 */

?>

<article <?php post_class('c-article c-site-wrap-small c-site-wrap__section'); ?>>

	<?php the_post_thumbnail('widescreen', ['class' => 'c-article__img img-fluid']); ?>

	<?php
	if ( is_singular() ) :
		the_title( '<h1 class="c-article__heading">', '</h1>' );
	else :
		the_title( '<h2 class="c-article__heading"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	?>

	<div class="c-article__content">
		<?php the_content(); ?>
	</div>

</article>

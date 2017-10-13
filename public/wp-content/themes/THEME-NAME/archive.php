<?php get_header(); ?>

<?php if ( have_posts() ) :

	the_archive_title( '<h1 class="page-title">', '</h1>' );
	the_archive_description( '<div class="taxonomy-description">', '</div>' );

	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content' );

	endwhile;

else:

	get_template_part( 'template-parts/content', 'none' );

endif; ?>

<?php
get_footer();

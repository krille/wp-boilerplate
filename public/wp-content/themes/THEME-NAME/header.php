<?php
/**
 * The header for our theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'has-fixed-head' ); ?>>

	<div class="c-off-canvas-nav c-site-wrap__section d-md-none">

		<div class="text-right">
			<a data-js="site-nav-toggle" href="#" aria-label="Stäng">
				<svg class="o-icon" aria-hidden="true">
					<use xlink:href="<?php echo get_template_directory_uri() . '/img/sprites/icon-sprite.svg#close'; ?>"></use>
				</svg>
			</a>
		</div>

		<?php
			wp_nav_menu( array(
				'theme_location' => 'main-nav',
				'menu_class' => 'c-off-canvas-nav__menu nav flex-column'
			) );
		?>
	</div>

	<header class="c-site-header" data-js="site-header">

		<div class="c-site-wrap c-site-wrap__section">
			<div class="d-flex justify-content-between">
				<a class="d-flex" href="/">
					<img class="c-site-header__logo" src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="logotyp" />
				</a>
				<nav class="d-flex align-self-end">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'main-nav',
							'menu_class' => 'c-site-nav nav justify-content-end d-none d-md-flex'
						) );
					?>
					<a class="d-md-none" href="#" data-js="site-nav-toggle" aria-label="Navigation">
						<svg class="c-site-header__menu o-icon" aria-hidden="true">
							<use xlink:href="<?php echo get_template_directory_uri() . '/img/sprites/icon-sprite.svg#menu'; ?>"></use>
						</svg>
					</a>
				</nav>
			</div>
		</div>

	</header>

	<main class="c-site-wrap">

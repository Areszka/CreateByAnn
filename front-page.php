<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
get_header();
?>
<div class="bigBox">
	<img class="image" src="<?php echo get_template_directory_uri() ?>/img/image.png" alt="">
	<div class="box"><?php echo esc_html(get_post_meta(get_the_ID(), "url", true))?></div>
</div>
<div class="btn">Zobacz produkt</div>
	<svg width="100%" viewBox="0 0 2304 478" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" clip-rule="evenodd" d="M1083 193.761C332.5 359.198 0 0 0 0V478H2304V448.598C2304 448.598 1833.5 28.3228 1083 193.761Z" fill="white"/></svg>
<div class="oMnie">
	<div class="section__header">O MNIE</div>
	<div class="bigBox2">
		<img class="image--omnie" src="<?php echo get_template_directory_uri() ?>/img/Filip.jpg" alt="">
		<div class="text--omnie"><?php echo esc_html(get_post_meta(get_the_ID(), "text", true))?></div>
	</div>
</div>
<svg width="100%" viewBox="0 0 2304 299" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V84.8513C508.747 341.743 917.117 286.017 1305.32 233.042C1636.3 187.876 1952.63 144.711 2304 299V0H0Z" fill="white"/></svg>
<div class="produkty">
<div class="section__header">PRODUKTY</div>

<?php
// Wyświetla kategorie w kolejności alfabetycznej
$categories = get_categories(
	array(
		'orderby' => 'name',
	)
);
echo( '<div class="produkty__categories">' );
foreach ( $categories as $category ) {
	echo( '<p class="produkty__category" data-category="' . $category->slug . '">' . esc_html( $category->name ) . '</p>' );
}
echo( '</div>' );

// Wyświetlanie tagów w kolejności alfabetycznej dla każdej kategorii
// (tag wyświetla się jeżeli istnieje produkt danej kategorii z tym tagiem)
$tags = get_tags(
	array(
		'orderby' => 'name',
	)
);
foreach ( $categories as $category ) {
	echo( '<div class="produkty__tags" data-category="' . $category->slug . '">' );
	foreach ( $tags as $tag ) {
		$args = array(
			'post_type'     => 'product',
			'category_name' => $category->slug,
			'tag_id'        => $tag->term_id,
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			echo( '<p class="produkty__tag" data-category="' . $category->slug . '" data-tag="' . $tag->term_id . '">' . esc_html( $tag->name ) . '</p>' );
		}
	}
	echo( '</div>' );
}
		// // Wyświetlanie produktów danego tagu i kategorii,
		// // zakomentowane bo nie było wcześniej wrzucane a gdzieś w ajaxie potem tego na pewno użyjemy
		// $args = array(
		// 'post_type'     => 'product',
		// 'category_name' => $category->slug,
		// 'tag_id'        => $tag->term_id,
		// );
		// $the_query = new WP_Query( $args );
		// if ( $the_query->have_posts() ) {
		// echo( '<ul class="produkty__list">' );
		// while ( $the_query->have_posts() ) {
		// $the_query->the_post();
		// echo '<li class="produkty__item">' . get_the_title() . '</li>';
		// }
		// wp_reset_postdata();
		// echo( '</ul>' );
		// }
?>
</div>

<svg width="100%" viewBox="0 0 544 125" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M544 5.90004V125H0V1.63685C66.4756 -4.2733 128.841 19.0585 191.234 42.4C301.191 83.5363 411.232 124.704 544 5.90004Z" fill="white"/>
</svg>

<div class="kontakt">
	<div class="section__header">KONTAKT</div>
	<p>Adres email: <?php echo esc_html(get_post_meta(get_the_ID(), "email", true))?></p>
	<p>Numer telefonu: <?php echo esc_html(get_post_meta(get_the_ID(), "numer", true))?></p>
	<form class="contact-form" action="contactform.php" method="post">
		<input type="text" name="name">
		<input type="text" name="mail">
		<input type="text" name="numer">
		<input type="text" name="name">
</div>
<?php get_footer(); ?>


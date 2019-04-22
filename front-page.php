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
<div class="btn--container">
    <div class="btn">Zobacz produkty</div>
</div>

<svg width="100%" viewBox="0 0 2304 478" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1083 193.761C332.5 359.198 0 0 0 0V478H2304V448.598C2304 448.598 1833.5 28.3228 1083 193.761Z" fill="white"/></svg>

<div class="oMnie">
	<div class="section__header"><p id="omnie">O MNIE</p></div>
	<div class="bigBox2">
		<img class="image--omnie" src="<?php echo get_template_directory_uri() ?>/img/Filip.jpg" alt="">
		<div class="text--omnie"><?php echo esc_html(get_post_meta(get_the_ID(), "text", true))?></div>
	</div>
</div>

<svg width="100%" viewBox="0 0 2304 299" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 0V84.8513C508.747 341.743 917.117 286.017 1305.32 233.042C1636.3 187.876 1952.63 144.711 2304 299V0H0Z" fill="white"/></svg>

<div class="produkty">
	<div class="section__header"><p id="produkty">PRODUKTY</p></div>

	<?php
	// Wyświetla kategorie w kolejności alfabetycznej
	$categories = get_categories(
		array(
			'orderby' => 'name',
		)
	);
	echo( '<div class="produkty__categories">' );
		echo( '<p class="produkty__category active" data-category="">Wszystkie</p>' );
		foreach ( $categories as $category ) {
		echo( '<p class="produkty__category" data-category="' . $category->term_id . '">' . esc_html( $category->name ) . '</p>' );
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
		echo( '<div class="produkty__tags" data-category="' . $category->term_id . '">' );
		foreach ( $tags as $tag ) {
			$args = array(
				'post_type'     => 'product',
				'category_name' => $category->slug,
				'tag_id'        => $tag->term_id,
			);
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) {
				echo( '<p class="produkty__tag" data-category="' . $category->term_id . '" data-tag="' . $tag->term_id . '">' . esc_html( $tag->name ) . '</p>' );
			}
		}
		echo( '</div>' );
	}
		echo( '<div class="produkty__tags active" data-category="">' );
		foreach ( $tags as $tag ) {
			echo( '<p class="produkty__tag" data-tag="' . $tag->term_id . '" data-category="">' . esc_html( $tag->name ) . '</p>' );
		}
		echo( '</div>' );
	?>
		
	<ul class="produkty__list">

	<?php
// The Query
$args = array(
	'post_type' => 'product',
	'posts_per_page' => 9,
);
$the_query = new WP_Query( $args );
// The Loop
if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo ( '<li class="produkty__item">' .
		'<div class="container">' . '<img src="' . esc_html( get_post_meta( get_the_ID(), 'image', true ) ) . '" alt="">' . '<div class="overlay"><div class="produkty__text">Zobacz</div></div></div>' .
		'<p class="produkty__nr">Nr ' . get_the_ID() . '</p>' .
		'<p class="produkty__price">' . esc_html( get_post_meta( get_the_ID(), 'price', true ) ) . ' zł</p>' .
		'</li>'
	);}
	wp_reset_postdata();
} else {
	// no posts found
}
?>

	</ul>
	<div class="modal">
		<div class="modal__shape">
			<div class="modal__picture">
				<img class="pic" src="<?php echo get_template_directory_uri() ?>/img/image.png" alt="">
			</div>
			<div class="modal__right">
				<div class="modal__text">
					 <h2>Tytuł kartki</h2>
					 <p>CENA: 34zł </p>
					 <p>NUMER KARTKI: 4</p>
				</div>
				<svg class="cross" xmlns="http://www.w3.org/2000/svg" width="17" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
				<div class="modal__pic"><img class="modal__logo" src="<?php echo get_template_directory_uri() ?>/img/logo2.png" alt=""></div>
			</div>
		</div>
	</div>
	<div class="produkty__nav">
		<svg class="arrow-back" style="visibility: hidden;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
		<span class="num"></span>
		<svg style="<?php echo wp_count_posts('product')->publish>9? 'visibility: visible;':'visibility: hidden;' ?>" class="arrow-forward" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
	</div>
</div>


<svg width="100%" viewBox="0 0 544 125" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M544 5.90004V125H0V1.63685C66.4756 -4.2733 128.841 19.0585 191.234 42.4C301.191 83.5363 411.232 124.704 544 5.90004Z" fill="white"/>
</svg>

<div class="kontakt">
	<div class="section__header"><p id="kontakt">KONTAKT</p></div>
	<p>Adres email: <?php echo esc_html(get_post_meta(get_the_ID(), "email", true))?></p>
	<p>Numer telefonu: <?php echo esc_html(get_post_meta(get_the_ID(), "numer", true))?></p>
	<form class="kontakt__form" action="contactform.php" method="post">
		<div class="myInput">
			<input type="text" name="name" id="name">
			<label for="name">Imię i nazwisko</label>
		</div>
		<div class="myInput">
			<input type="text" name="subject" id="subject">
			<label for="subject">Temat</label>
		</div>
		<div class="myInput">
			<input type="text" name="numer" id="numer">	
			<label for="numer">Numer telefonu</label>
		</div>
		<div class="myInput">
			<input type="text" name="message" id="message">
			<label for="message">Treść wiadomości</label>
		</div>
	</form>
	<div class="btn--container">
    	<div class="btn">Wyślij</div>
	</div>
</div>
<?php get_footer(); ?>


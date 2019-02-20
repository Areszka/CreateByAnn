<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<div class="bigBox">
    <img class="image" src="<?php echo get_template_directory_uri() ?>/img/image.png" alt="">
    <div class="box">Ręcznie robione z sercem i kotem. Każda kartka wyjątkowa, nie ma dwóch takich samych</div>
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
<ul class="produkty__list">
    <li class="produkty__item">WSZYSTKO</li>
    <li class="produkty__item">NOWOŚCI</li>
    <li class="produkty__item">KARTKI</li>
    <li class="produkty__item">PUDEŁKA</li>
    <li class="produkty__item">ARCHIWUM</li>
</div>

<?php get_footer(); ?>


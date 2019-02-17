<?php

if (!defined('ABSPATH')) {
	exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body>
    <div class="header">
        <div class="logo">
            <img class="logo--image logo--shadow" src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="">
            <span class="logo--text">CreateByAnn</span>
        </div>
		<div class="nav__icon">
			<svg class="icon1" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
			<svg class="icon2 icon--no" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
		</div>
		<div class="nav">
			<ul class="nav__list nonav">
                <li class="nav__item"><a href="#">PRODUKTY</a></li>
                <li class="nav__item"><a href="#">O MNIE</a></li>
                <li class="nav__item"><a href="#">KONTAKT</a></li>
            </ul>
        </div>
	</div>
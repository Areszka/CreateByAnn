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
    <div id="header" class="header--menu">
        <div class="logo">
            <img class="logo--image" src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="">
            <span class="logo--text shadow">CreateByAnn</span>
        </div>
		<div class="menu">
			<svg class="menu--no" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg>
			<svg class="" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>
		</div>
		<div class="nav">
			<ul class="nav__list nav--menu">
                <li class="item__menu"><a href="#">PRODUKTY</a></li>
                <li class="item__menu"><a href="#">O MNIE</a></li>
                <li class="item__menu"><a href="#">KONTAKT</a></li>
                <li class="item__menu"><a href="#"><svg class="shadow" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z" /></svg></a></li>
            </ul>
        </div>
	</div>
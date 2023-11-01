<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="header sticky-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
            <a class="navbar-brand text-white" href="index.php">Company Logo</a>
            <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-dark "></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <?php
                // Show Custom Menu and add a custom class to the ul element
                $args = array(
                    'menu_class'  => 'navbar-nav mx-auto', 
                );
                wp_nav_menu( $args );
                ?>
            </div>
        </nav>
    </div>
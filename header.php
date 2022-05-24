<!DOCTYPE html>
<html lang="de-CH">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri();?>/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri();?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
    <title><?php the_title();?></title>
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<div id="header" class="container">
    <div id="menu-toggle">
        <span class="menu-text" id="menu-text-closed">Menu</span>
        <span class="menu-text" id="menu-text-open">Close</span>
        <div id="nav-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="mobile-menu">
        <div class="inner">
            <?php echo do_shortcode('[ivory-search id="123" title="Default Search Form"]'); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) );?>
            <?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) );?>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <?php $logo = get_field('logo','options');
            $url = home_url();
            ?>
            <a id="logo" href="<?php echo $url; ?>"><img src="<?php echo $logo; ?>" alt="Logo"></a>
        </div>
        <div class="col-9">
            <div id="top">
                <?php echo do_shortcode('[ivory-search id="123" title="Default Search Form"]'); ?>
                <?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) );?>
            </div>
            <?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) );?>
        </div>
        <div id="megamenu">
            <div class="inner">
                <div class="row">
                <?php
                if( have_rows('megamenu_columns','options') ):
                    $i = 1;
                    while( have_rows('megamenu_columns','options') ) : the_row();?>
                        <div class="col-25">
                            <h3><?php the_sub_field('column_title');?></h3>
                            <?php
                            if( have_rows('column_links','options') ):
                                while( have_rows('column_links','options') ) : the_row();
                                    $link_title = get_sub_field('link_title');
                                    $link_url = get_sub_field('link_url');
                                    $site_url = get_site_url();
                                    ?>
                                    <div class="mega-link">
                                        <a href="<?php echo $site_url.$link_url; ?>"><?php echo $link_title; ?></a>
                                    </div>
                                    <?php
                                endwhile;
                            endif;?>
                        </div>
                        <?php if($i===5){
                        ?> </div><div class="row"><?php
                        }
                        $i++;
                    endwhile;
                endif;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
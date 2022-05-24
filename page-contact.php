<?php
/*
Template name: Contact
*/
get_header();?>
	<div id="content" class="container page-contact">
        <div class="megaoverlay"></div>
        <h1 class="a-hidden"><?php the_title();?></h1>
        <div id="content"><?php the_content();?></div>
        <div id="contact-rows">
        <?php
        if( have_rows('company') ):
            while( have_rows('company') ) : the_row();
                $company_image = get_sub_field('image');
                $company_title = get_sub_field('title');
                $company_email = get_sub_field('email');
                $company_logo = get_sub_field('logo');
                ?>
                <div class="contact-row">
                    <div class="company-image">
                        <img class="company-logo" src="<?php echo $company_logo;?>" alt="logo">
                        <img src="<?php echo $company_image;?>">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h2><?php echo $company_title;?></h2>
                            <?php 
                            if( have_rows('description') ):
                                while( have_rows('description') ) : the_row();
                                $company_desc = get_sub_field('description');
                                ?>
                                <div class="company-desc"><?php echo $company_desc;?></div>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <div class="col-6">
                            <?php 
                            if( have_rows('maps_link') ):
                                while( have_rows('maps_link') ) : the_row();
                                $company_maps = get_sub_field('maps_link');
                                $company_location = get_sub_field('location');
                            ?>
                            <div class="maps-link">
                                <h3>Anfahrt <?php echo $company_location;?></h3>
                                <a class="arrow" href="<?php echo $company_maps; ?>" target="_blank">Karte anzeigen</a>
                            </div>
                            <?php
                                endwhile;
                            endif;
                            ?>
                            <div class="email">
                                <h3>Kontakt</h3>
                                <a class="arrow" href="mailto:<?php echo $company_email; ?>">E-Mail senden</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
        </div>
    </div>
    <script>
    jQuery(document).ready(function($){
        // Animations
        (function () {
            setTimeout(init, 500);
            function init() {
                $('.a-hidden').css('visibility','visible');
                var rev2 = new RevealFx(document.querySelector('h1'), {
                    revealSettings: {
                        bgcolor: '#FAFAFA',
                        duration: 300,
                        onCover: function (contentEl, revealerEl) {
                            contentEl.style.opacity = 1;
                        }
                    }
                });
                rev2.reveal();
            }
        })();
    });
    </script>
<?php get_footer();?>
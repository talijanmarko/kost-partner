<?php
/*
Template name: Company overview
*/
get_header();?>
	<div id="content" class="container page-overview">
        <div class="megaoverlay"></div>
        <div id="overview-front">
            <h1 class="a-hidden"><?php the_title();?></h1>
            <div class="row">
                <div class="col-8">
                    <?php the_content();?>
                </div>
            </div>
        </div>
        <div id="overview-top">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php
            if( have_rows('companies')):
                while( have_rows('companies') ) : the_row();
                	$company_link = get_sub_field('company_link');
                    $company_image = get_sub_field('company_image');
                    $company_title = get_sub_field('company_title');
                    $company_description = get_sub_field('company_description');
                    ?>
                    <div class="col-4">
                        <div class="inner">
                            <a href="<?php echo $company_link;?>"><img src="<?php echo $company_image; ?>"></a>
                            <a href="<?php echo $company_link;?>"><h3><?php echo $company_title; ?></h3></a>
                            <div class="company-text"><?php echo $company_description; ?></div>
                        </div>
                    </div>
                    <?php
                endwhile;
            endif;?>
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
<?php
/*
Template name: Services overview
*/
get_header();?>
	<div id="content" class="container page-services">
        <div class="megaoverlay"></div>
        <div id="services-top" class="corner-left-white animate">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="inner">
                    <h1 class="a-hidden"><?php the_title();?></h1>
                    <?php the_content();?>
                </div>
            </div>
        </div>
        <div id="services-overview">
            <h3>Leistungen & Lösungen</h3>
            <?php 
            $args = array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => '_wp_page_template',
                        'value' => 'page-services.php',
                        'orderby' => 'date'
                    )
                )
            );
            $the_pages = new WP_Query( $args );
            $counter = $the_pages->found_posts;
            if( $the_pages->have_posts() ){
                $count = 0;
                while( $the_pages->have_posts() ){
                    if($count==0||$count==3||$count==6||$count==9||$count==12){
                        ?>
                        <div class="row">
                        <?php
                    }
                    $the_pages->the_post();
                    ?>
                    <div class="col-4">
                        <div class="inner">
                    <?php
                    if ( has_post_thumbnail() ) :?>
                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail();?></a>
                    <?php endif; ?>
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                        <p>
                        <?php
                        if(get_field('teaser')){
                            the_field('teaser');
                        }else{
                            $excerpt = get_the_excerpt();
                            $excerpt = substr($excerpt, 0, 100);
                            $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                            echo $result;
                        }
                        ?></p>
                        </div>
                    </div>
                    <?php
                    if($count==2||$count==5||$count==8||$count==11||$count==14){
                        ?>
                        </div>
                        <?php
                    }
                    $count++;
                }
            }
            wp_reset_postdata();
            if($counter % 3 != 0){
                ?>
                </div>
                <?php
            }
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

                var rev1 = new RevealFx(document.querySelector('.animate'), {
                    revealSettings: {
                        bgcolor: '#fff',
                        duration: 700,
                        onCover: function (contentEl, revealerEl) {
                            contentEl.style.opacity = 1;
                        }
                    }
                });
                rev1.reveal();

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

                $('#services-top').css('opacity','1');
            }
        })();
    });
    </script>
<?php get_footer();?>
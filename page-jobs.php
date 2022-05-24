<?php
/*
Template name: Jobs
*/
get_header();?>
	<div id="content" class="container page-jobs">
        <div class="megaoverlay"></div>
        <h1 class="a-hidden"><?php the_title();?></h1>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="animate">
                <img src="<?php the_post_thumbnail_url(); ?>">
            </div>
        <?php endif; ?>
        <div id="content"><?php the_content();?></div>
        <div id="jobs">
                <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                    'paged' => $paged,
                    'post_type' => 'job',
                    'post_status' => 'publish',
					'meta_key'	=> 'location',
					'orderby' => array( 
					   'meta_value' => 'DESC', 
					   'date' =>'DESC'
					) 
                );
                $wp_query = new WP_Query( $args );
                if($wp_query->have_posts()){
					$i = 0;
					$n = 0;
                    while($wp_query->have_posts()){ 
                        $wp_query->the_post();
						$location = get_field('location');
						if($location=='Standort Sursee'):
							if($i==0):
								echo '<h2>'.$location.'</h2>';
								$i++;
							endif;
						endif;
						if($location=='Standort Luzern'):
							if($n==0):
								echo '<h2 style="margin-top:75px">'.$location.'</h2>';
								$n++;
							endif;
						endif;
                        ?>
                        <div class="expanding-row">
                            <div class="expanding-title">
                                <h2><?php the_title(); ?></h2>
                            </div>
                            <div class="expanding-text">
                                <p>
                                <?php
                                $excerpt = get_the_excerpt();
                                $excerpt = substr($excerpt, 0, 100);
                                $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                                if(get_field('teaser')){
                                    the_field('teaser');
                                }else{
                                    echo $result;
                                }
                                ?></p>
                                <a class="arrow" href="<?php the_permalink(); ?>">Zum Stellenprofil</a>
                            </div>
                        </div>
                        <?php 
                    }
                    the_posts_pagination( array( 'mid_size'  => 2, 'prev_next' => false ) );
                }else{
                }
                wp_reset_postdata();
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
                        //delay: 200,
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
            }
        })();
    });
    </script>
<?php get_footer();?>
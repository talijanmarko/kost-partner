<?php
/*
Template name: Homepage
*/
get_header();?>
	<div id="content" class="container">
        <div class="megaoverlay"></div>
        <div id="home-top">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="animate">
                <img src="<?php the_post_thumbnail_url(); ?>">
            </div>
            <?php endif; ?>
            <div id="top-text" class="a-hidden">
                <h1><?php the_title();?></h1>
                <?php the_content();?>
            </div>
        </div>
        <div id="home-middle">
            <div class="row">
                <div class="col-3">
                    <h2 id="animate-1"><?php the_field('home_middle_title');?></h2>
                </div>
                <div class="col-8">
                    <br>
                    <div id="home-middle-text"><?php the_field('home_middle_text');?></div>
                </div>
            </div>
        </div>
        <div class="hidden-sm">
            <div id="newest-projects" class="three-items">
                <h2 id="animate-2">Weitere Projekte</h2>
                <?php
                    $args = array(
                    'post_type' => 'project',
                    'post_status' => 'publish',
                    'posts_per_page' => 3
                );
                $newPosts = new WP_Query( $args );
                if($newPosts->have_posts()){
                    echo '<div class="row">';
                    while($newPosts->have_posts()){ 
                        $newPosts->the_post();
                        ?>
                        <div class="col-4">
                            <div class="inner">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a class="project-image" href="<?php the_permalink(); ?>" style="background-image: url('<?php $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'medium'); echo $featured_img_url;?>');"></a>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <div class="subtitle"><?php the_field('subtitle');?> </div>
                            </div>
                        </div>
                <?php
                    }
                    echo '</div>';
                }
                wp_reset_postdata();
                ?>
            </div>
            <div class="row">
                <div id="news" class="col-8">
                    <h2>News</h2>
                    <?php
                        $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 2
                    );
                    $news = new WP_Query( $args );
                    if($news->have_posts()){
                        while($news->have_posts()){ 
                            $news->the_post();
                            ?>
                            <div class="col-6">
                                <div class="inner">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <?php if(get_field('teaser')){
                                    ?><p><?php
                                        the_field('teaser');
                                    ?></p><?php
                                    }else{
                                        the_excerpt();
                                    }
                                    ?>
                                    <?php the_time('d. M. Y');?>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <div id="jobs" class="col-4">
                    <div class="inner">
                        <h2>Jobs</h2>
                        <?php
                            $args = array(
                            'post_type' => 'job',
                            'post_status' => 'publish',
                            'posts_per_page' => 4
                        );
                        $jobs = new WP_Query( $args );
                        if($jobs->have_posts()){
                            while($jobs->have_posts()){ 
                                $jobs->the_post();
                                ?>
                                <div class="job-link">
                                    <a class="arrow" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </div>
                        <?php
                            }
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
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
                        //direction: 'rl',
                        //delay: 400,
                        onCover: function (contentEl, revealerEl) {
                            contentEl.style.opacity = 1;
                        }
                    }
                });
                rev2.reveal();

                var rev3 = new RevealFx(document.querySelector('h2'), {
                    revealSettings: {
                        bgcolor: '#FAFAFA',
                        duration: 300,
                        //delay: 600,
                        onCover: function (contentEl, revealerEl) {
                            contentEl.style.opacity = 1;
                        }
                    }
                });
                rev3.reveal();
                $('#home-top').css('opacity','1');
                
            }
        })();
    });
    </script>
<?php get_footer();?>
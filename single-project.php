<?php get_header();?>
<div id="content" class="container project-details">
    <div class="megaoverlay"></div>
    <div id="project-top">
        <h1 class="a-hidden"><?php the_title();?></h1>
        <?php if ( has_post_thumbnail() ) : ?>
            <div id="project-image">
                <div class="animate">
                    <img src="<?php the_post_thumbnail_url(); ?>">
                </div>
            </div>
        <?php endif; ?>
        <div class="row top-description">
            <div class="col-8">
                <?php the_field('description'); ?>
            </div>
            <div class="col-4">
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <?php the_content();?>
                <?php 
                $images = get_field('gallery');
                if( $images ): ?>
                    <div id="gallery">
                        <h2>Galerie</h2>
                        <?php
                        $count_images = count($images);
                        if($count_images>1):
                        ?>
                        <div id="controls">
                            <img id="slide-left" src="<?php echo get_stylesheet_directory_uri(); ?>/css/img/slider-left.svg">
                            <img id="slide-right" src="<?php echo get_stylesheet_directory_uri(); ?>/css/img/slider-right.svg">
                        </div>
                        <?php endif; ?>
                        <div id="gallery-images">
                        <?php foreach( $images as $image ): ?>
                            <div class="gallery-row">
                                <a href="<?php echo $image['url'];?>" data-fancybox="gallery">
                                    <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </a>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-4 sidebar">
                <div class="inner">
                    <?php if(get_field('auftraggeber')){?>
                        <h3>Auftraggeber</h3>
                        <p><?php the_field('auftraggeber');?></p>
                    <?php }?>
                    <?php if(get_field('realisation')){?>
                        <h3>Realisation</h3>
                        <p><?php the_field('realisation');?></p>
                    <?php }?>
                    <?php if(get_field('weitere_beteiligte')){?>
                        <h3>Weitere Beteiligte</h3>
                        <p><?php the_field('weitere_beteiligte');?></p>
                    <?php }?>
                    <?php
                    if( have_rows('downloads') ):
                        ?><h3>Downloads</h3><?php
                        while( have_rows('downloads') ) : the_row();
                                $file_url = get_sub_field('file');
                                $file_name = get_sub_field('file_name');
                                ?>
                                <div class="download">
                                    <span class="file-name"><?php echo $file_name; ?></span><a href="<?php echo $file_url; ?>" target="_blank">Herunterladen</a>
                                </div><?php
                        endwhile;
                        else :
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <div id="related-projects" class="three-items hidden-sm">
            <div id="all-projects-link"><a href="/ausgewahlte-ingenieurs-und-bauprojekte">Alle</a></div>
            <h2>Weitere Projekte</h2>
            <?php
                $post_tag = get_the_tags ( $post->ID );
                if ( $post_tag ) {
                    $ids = wp_list_pluck( $post_tag, 'term_id' );
                }
                $args = array(
                'post_type' => 'project',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'orderby' => 'rand',
                'tag__in'   => $ids,
                'post__not_in' => array ($post->ID)
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
                                <a class="project-image" href="<?php the_permalink(); ?>" style="background: url('<?php the_post_thumbnail_url('medium'); ?>') no-repeat center center/cover;"></a>
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
                $('#project-image').css('opacity','1');
            }
        })();
    });
    </script>
<?php get_footer();?>
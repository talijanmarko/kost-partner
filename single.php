<?php get_header();?>
<div id="content" class="container single-blog">
    <div class="megaoverlay"></div>
    <div id="blog-top">
        <h1 class="a-hidden"><?php the_title();?></h1>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="inner">
                <?php the_content();?>
                <div id="downloads">
                    <?php
                    if( have_rows('downloads') ):
                        ?><h3>Downloads</h3><?php
                        while( have_rows('downloads') ) : the_row();
                                $file_url = get_sub_field('file');
                                $file_name = get_sub_field('file_name');
                                ?>
                                <div class="download">
                                    <span class="file-name"><?php echo $file_name; ?></span><a href="<?php echo $file_url; ?>" target="_blank">download</a>
                                </div><?php
                        endwhile;
                        else :
                    endif;
                    ?>
                </div>
                <?php 
                $images = get_field('gallery');
                if( $images ): 
                ?>
                
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
                <div id="news">
                        <h2>Ähnliche News</h2>
                        <?php
                            $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 3,
                            'orderby' => 'rand',
                            'post__not_in' => array ($post->ID)
                        );
                        $relatedPosts = new WP_Query( $args );
                        if($relatedPosts->have_posts()){
                            while($relatedPosts->have_posts()){ 
                                $relatedPosts->the_post();
                        ?>
                            <div class="news">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php the_excerpt(); ?>
                                <a class="arrow" href="<?php the_permalink(); ?>">Mehr</a>
                            </div>
                        <?php
                            }
                        }else{
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
            </div>
        </div>
        <div class="col-4 sidebar">
            <div class="inner">
                <ul id="sidebar-menu">
                    <?php 
                    $menu_items = wp_get_nav_menu_items('sidebar-menu');
                    foreach( $menu_items as $menu_item ) {
                        $link = $menu_item->url;
                        $title = $menu_item->title;
                        ?>
                        <li>
                            <a href="<?php echo $link; ?>"><?php echo $title; ?><span class="arrow">Mehr</span></a>
                        </li>
                        <li>
                            <a href="/ingenieur-partner-news-kostpartner">Zu allen News<span class="arrow">Zurück</span></a>
                        </li>
                        <?php
                    }?>
                </ul>
                <?php
                $author_id = get_field('author');
                if( $author_id ): 
                    $permalink = get_permalink($author_id);
                    $title = get_the_title($author_id);
                    $content = get_post_field('post_content', $author_id);
                    $image = get_the_post_thumbnail( $author_id, 'medium' );
                    ?>
                    <div id="author">
                        <h3>Author</h3>
                        <div class="member-image">
                            <?php echo $image;?>
                        </div>
                        <div class="member-info">
                            <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
                            <?php echo $content; ?>
                            <a class="arrow" href="<?php echo esc_url( $permalink ); ?>">Kontakt</a>
                        </div>
                    </div>
                <?php endif; ?>
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
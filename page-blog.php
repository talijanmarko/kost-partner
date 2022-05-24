<?php
/*
Template name: Blog
*/
get_header();?>
	<div id="content" class="container page-blog">
        <div class="megaoverlay"></div>
        <div id="blogs-top">
            <h1 class="a-hidden"><?php the_title();?></h1>
            <?php the_content();?>
        </div>
        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter-time">
                <select name="blog-year">
                    <option value="">Jahr</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                </select>
                <select name="blog-month">
                    <option value="">Monat</option>
                    <option value="1">Januar</option>
                    <option value="2">Februar</option>
                    <option value="3">März</option>
                    <option value="4">April</option>
                    <option value="5">Mai</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">Novemeber</option>
                    <option value="12">Dezember</option>
                </select>
                <input val="" name="blog-cat" id="blog-cat">
                <button>Apply filter</button>
                <input type="hidden" name="action" value="blogfilter">
            </form>
        <div id="all-posts">
            <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                'paged' => $paged,
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 10
            );
            $wp_query = new WP_Query( $args );
            if($wp_query->have_posts()){
                $count = 0;
                while($wp_query->have_posts()){ 
                    $wp_query->the_post();
                    ?>
                        <div class="news">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <div class="news-date"><?php the_time('d. M. Y');?></div>
                            <div><?php 
                            if(get_field('teaser')){
                                the_field('teaser');
                            }else{
                                the_excerpt();
                            }
                            ?>
                            </div>
                            <a class="arrow" href="<?php the_permalink(); ?>">Mehr</a>
                        </div>
                    <?php 
                }
                the_posts_pagination();
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
<?php
/*
Template name: Projects
*/
get_header();?>
	<div id="content" class="container projects-page">
        <div class="megaoverlay"></div>
        <div id="projects-top">
            <h1 class="a-hidden"><?php the_title();?></h1>
            <?php the_content();?>
            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
                <?php
                    if( $terms = get_tags( array( 'taxonomy' => 'post_tag', 'orderby' => 'name', 'type' => 'project', 'hide_empty' => true  ) ) ) : 
            
                        echo '<select name="categoryfilter"><option value="">Select category...</option>';
                        foreach ( $terms as $term ) :
                            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
                        endforeach;
                        echo '</select>';
                    endif;
                ?>
                <button>Apply filter</button>
                <input type="hidden" name="action" value="myfilter">
            </form>
            <div id="response"></div>
            <div id="project-tags">
                <?php 
                $args = array(
                    'type' => 'project',
                    'hide_empty' => true
                );
                $tags = get_tags($args);
                $html = '<div class="post_tags">';
                foreach ( $tags as $tag ) {
                    $tag_link = get_tag_link( $tag->term_id );
                             
                    $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                    $html .= "{$tag->name}</a>";
                }
                $html .= '</div>';
                echo $html;
                ?>
            </div> 
        </div>
        <div id="all-projects">
            <?php
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $args = array(
                'paged' => $paged,
                'post_type' => 'project',
                'post_status' => 'publish',
                'posts_per_page' => 10
            );
            $wp_query = new WP_Query( $args );
            if($wp_query->have_posts()){
                $count = 0;
                while($wp_query->have_posts()){ 
                    $wp_query->the_post();
                    if($count==0||$count==2||$count==5||$count==8||$count==11||$count==14){
                        ?>
                        <div class="row">
                        <?php
                    }
                    if($count==0||$count==1){
                        ?>
                        <div class="col-6">
                        <?php
                    }else{
                        ?>
                        <div class="col-4">
                        <?php
                    }
                    ?>
                        <div class="project">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a class="img" href="<?php the_permalink(); ?>" style="background: url('<?php the_post_thumbnail_url('medium'); ?>') no-repeat center center / cover;"></a>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <div class="subtitle"><?php the_field('subtitle');?></div>
                        </div>
                    </div>
                    <?php 
                    if($count==1||$count==4||$count==7||$count==10||$count==13){
                        ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php $count++;
                }
                ?>
                </div>
                <?php
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
<?php get_header();?>
<div id="content" class="container archive">
    <h1><?php the_archive_title();?></h1>
<?php
    $cat_id = get_queried_object()->term_id;
    $args = array(
    'post_type' => 'any',
    'post_status' => 'publish',
    'cat' => $cat_id
);
$wp_query = new WP_Query( $args );
if($wp_query->have_posts()){
    $count = 0;
    while($wp_query->have_posts()){ 
        $wp_query->the_post();
        ?>
            <div class="news">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <p>
                <?php
                $excerpt = get_the_excerpt();
                $excerpt = substr($excerpt, 0, 100);
                $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                echo $result;
                ?></p>
                <a class="arrow" href="<?php the_permalink(); ?>">Mehr</a>
            </div>
        <?php 
    }
}
wp_reset_postdata();
?>

</div>
<?php get_footer();?>
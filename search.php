<?php get_header(); ?>
<div id="content" class="container page-search">
    <div class="megaoverlay"></div>
    <?php if ( have_posts() ) : ?>
        <h1>Suchergebnisse für: <?php $s = $_GET['s']; echo $s; ?></h1>
        <?php
        while ( have_posts() ) :
            the_post(); ?>
            <div class="search-row">
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                <p>
                <?php
                $excerpt = get_the_excerpt();
                $excerpt = substr($excerpt, 0, 100);
                $result = substr($excerpt, 0, strrpos($excerpt, ' '));
                echo $result;
                ?></p>
                <a class="arrow" href="<?php the_permalink();?>">Mehr</a>
            </div>
            <?php
        endwhile;
        else: ?>
        <h1>No search resuls for: <?php $s = $_GET['s']; echo $s; ?></h1>
        <?php
    endif; ?>
    <div id="search-again">
        <h2>Search again</h2>
        <?php echo do_shortcode('[ivory-search id="123" title="Default Search Form"]'); ?>
        <div class="clear-search"></div>
    </div>
</div>
<?php get_footer(); ?>
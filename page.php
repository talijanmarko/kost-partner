<?php get_header();?>
<div id="content" class="container page-simple">
    <div class="megaoverlay"></div>
    <div class="inner">
        <div class="row">
            <div class="col-8">
                <h1><?php the_title();?></h1>
                <?php the_content();?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
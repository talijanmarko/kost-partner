<?php get_header();?>
<div id="content" class="container single-job">
    <div id="job-info">
        <div><button onclick="window.history.back()">Zurück</button></div>
        <h1><?php the_title();?></h1>   
        <?php the_content();?>
    </div>
</div>        
<?php get_footer();?>

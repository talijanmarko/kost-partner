<div id="footer" class="container">
    <div class="megaoverlay"></div>
    <div id="footer-top">
        <div class="row">
            <div class="col-3">
                <img src=<?php the_field('footer_logo','options'); ?>>
                <span id="copyright"><?php the_field('copyright','options'); ?></span>
            </div>
            <?php
            if( have_rows('links','options') ):
                while( have_rows('links','options') ) : the_row();
                    $link_url = get_sub_field('link_url','options');
                    $link_text = get_sub_field('link_text','options');
                    ?>
                    <div class="col-3">
                        <a href="<?php echo $link_url; ?>"><?php echo $link_text;?></a>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
    <div id="footer-middle">
        <div class="row">
            <?php 
            if( have_rows('footer_columns','options') ):
                while( have_rows('footer_columns','options') ) : the_row();
                    $column_title = get_sub_field('column_title','options');
                    $column_text = get_sub_field('column_text','options');
                    ?>
                    <div class="col-3">
                        <h3><?php echo $column_title;?></h3>
                        <?php echo $column_text;?>
                    </div>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
    <div id="footer-bottom">
        <div class="row">
        <div class="col-9" id="social-links">
            <?php
            if( have_rows('social_links','options') ):
                while( have_rows('social_links','options') ) : the_row();
                    $social_icon = get_sub_field('social_icon','options');
                    $social_url = get_sub_field('social_url','options');
                    ?>
                    <a target="_blank" href="<?php echo $social_url; ?>"><img src="<?php echo $social_icon ?>"></a>
                    <?php
                endwhile;
            endif;
            ?>
        </div>
        <div class="col-3" id="sitemap-link">
            <?php $sitemap_url = get_field('sitemap_url','options'); ?>
            <a href="<?php echo $sitemap_url; ?>">Impressum & Datenschutz</a>
        </div>
    </div>
</div>
<?php wp_footer();?>
</body>
</html>
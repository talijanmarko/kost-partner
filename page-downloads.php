<?php 
/*
Template name: Downloads
*/
get_header();?>
<div id="content" class="container page-downloads">
    <div class="megaoverlay"></div>
    <h1 class="a-hidden"><?php the_title();?></h1>
    <?php
    if( have_rows('downloads') ):
        while( have_rows('downloads') ) : the_row();
                $file_id = get_sub_field('file');
                $file_name = get_sub_field('file_name');
                $filesize = filesize(get_attached_file($file_id));
                $file_url = wp_get_attachment_url($file_id);
                $formated_filesize = number_format($filesize / 1024, 2) . ' KB';
                ?>
                <div class="download">
                    <span class="file-name"><?php echo $file_name; ?></span><span class="file-size">(<?php echo $formated_filesize; ?>)</span><a href="<?php echo $file_url; ?>" target="_blank">download</a>
                </div><?php
        endwhile;
        else :
    endif;
    ?>
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
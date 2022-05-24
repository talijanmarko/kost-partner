<?php
/*
Template name: Services
*/
get_header();?>
    <?php 
    global $post;
    $postid = $post->ID;
    ?>
	<div id="content" class="container page-services">
        <div class="megaoverlay"></div>
        <div id="services-top" class="corner-left-white animate">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="inner">
                    <h1 class="a-hidden"><?php the_title();?></h1>
                    <?php the_content();?>
                    <div id="services-expandable">
                        <?php
                        if( have_rows('expanding_items') ):
                            while( have_rows('expanding_items') ) : the_row();
                            ?>
                            <div class="expanding-row">
                                <div class="expanding-title">
                                    <?php the_sub_field('expanding_title'); ?>
                                </div>
                                <div class="expanding-text">
                                    <?php the_sub_field('expanding_text'); ?>
                                </div>
                            </div>
                            <?php
                            endwhile;
                        endif;
                        ?>
                    </div>
                    <?php
                    if(get_field('formular_link')):
                    ?>
                    <div id="formular-link" class="<?php $formular_color = get_field('formular_color'); if($formular_color==1){echo 'blue';}else if($contact_company==2){echo 'red';}else if($contact_company==3){echo 'green';}?>">
                        <h2>Bestellformular Geodaten</h2>
                        <a href="<?php the_field('formular_link');?>">Anzeigen</a>
                    </div>
                    <?php
                    endif; 
                    ?>
                    <div class="anchor" id="projekte"></div>
                    <div id="projects">
                        
                           <?php
                        $projects = get_field('projects');
                        if( $projects ):
                            $n=1;
                            ?>
                            <div id="all-projects-link"><a href="/ausgewahlte-ingenieurs-und-bauprojekte">Alle</a></div>
                            <h2>Projekte</h2>
                            <div class="row"><?php 
                            foreach( $projects as $project ):
                                if($n<3):
                                ?>
                                <div class="col-6">
                                    <div class="inner">
                                        <div class="project">
                                            <?php if ( has_post_thumbnail($project) ) : ?>
                                                <a class="project-image" href="<?php the_permalink($project); ?>" style="background: url('<?php echo get_the_post_thumbnail_url($project,'medium'); ?>') no-repeat center center/cover;"></a>
                                            <?php endif; ?>
                                            <a href="<?php the_permalink($project); ?>"><?php echo get_the_title($project); ?></a>
                                            <div class="subtitle"><?php the_field('subtitle',$project);?> </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php
                            $n++; 
                            endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-4 sidebar">
                <div class="inner">
                    <div id="sidebar-contacts">
                        <?php
                        if( have_rows('contacts',$postid) ):
                            ?><h3>Kontakt</h3><?php
                            while( have_rows('contacts',$postid) ) : the_row();
                                    $contact_id = get_sub_field('contact',$postid);
                                    $contact_name = get_the_title($contact_id);
                                    $contact_link = get_the_permalink($contact_id);
                                    $contact_image = get_the_post_thumbnail_url($contact_id);
                                    $contact_content = get_post_field('post_content', $contact_id);
                                    $contact_company = get_field('company', $contact_id);
                                    ?>
                                    <div class="contact-person <?php if($contact_company==1){echo 'blue';}else if($contact_company==2){echo 'red';}else if($contact_company==3){echo 'green';}?>">
                                        <div class="inner">
                                            <div class="row">
                                                <div class="col-7">
                                                    <div class="contact-info">
                                                        <div><a href="<?php echo $contact_link; ?>"><?php echo $contact_name; ?></a></div>
                                                        <div><?php echo $contact_content; ?></div>
                                                        <div><a href="<?php echo $contact_link; ?>" class="arrow-white">Kontakt</a></div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="contact-image">
                                                        <img src="<?php echo $contact_image;?>">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                            endwhile;
                            else :
                        endif;
                        ?>
                    </div>
                    <div id="sidebar-downloads">
                        <?php
                        if( have_rows('downloads',$postid) ):
                            ?><h3>Downloads</h3><?php
                            while( have_rows('downloads',$postid) ) : the_row();
                                    $file_url = get_sub_field('file',$postid);
                                    $file_name = get_sub_field('file_name',$postid);
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


                $('#services-top').css('opacity','1');
                
            }
        })();
    });
    </script>
<?php get_footer();?>
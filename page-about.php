<?php
/*
Template name: About
*/
get_header();
    $page_id = get_the_ID();?>
	<div id="content" class="container page-about">
        <div class="megaoverlay"></div>
        <div id="about-us-top" class="corner-left-white animate">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail(); ?>
            <?php endif; ?>
        </div>
        <div id="about-us-middle">
        <div class="row">
            <div class="col-8">
                <div class="inner">
                    <h1 class="a-hidden"><?php the_title();?></h1>
                    <?php the_content();?>
                    <div id="about-members">
                            <?php
                            $members = get_field('members');
                            if($members): ?>
                                <h2>Geschäftsleitung</h2>
                                <div class="row">
                                <?php $counter = 1; ?>
                                <?php foreach($members as $member): 
                                    $permalink = get_permalink($member);
                                    $title = get_the_title($member);
                                    $content = get_post_field('post_content', $member);
                                    $image = get_the_post_thumbnail( $member, 'medium' );
                                    $email = get_field('email', $member);
                                    ?>
                                    <div class="col-6">
                                        <div class="inner">
                                            <div class="row">
                                                <div class="col-7">
                                                    <div class="member-info">
                                                        <a class="member-name" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
                                                        <div><?php echo $content;?></div>
                                                        <?php if($email):?>
                                                        <a class="arrow" href="mailto:<?php echo $email;?>">Kontakt</a>
                                                        <?php endif;?>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="member-image">
                                                        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo $image;?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                    if($counter % 2 == 0):?>
                                    </div><div class="row">
                                    <?php
                                    endif;
                                    ?>
                                <?php $counter++;?>
                                <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        <div id="see-all">
                            <a class="arrow" href="<?php the_field('members_page_link',$page_id); ?>">Zu allen Mitarbeitenden</a>
                        </div>
                    </div>
                    <div id="projects">
                        <h2>Projekte</h2>
                        <div class="row">
                        <?php
                        $projects = get_field('projects');
                        if( $projects ): 
                            foreach( $projects as $project ):  
                                    ?>
                                <div class="col-6">
                                    <div class="inner">
                                        <div class="project">
                                            <?php if ( has_post_thumbnail($project) ) : ?>
                                                <a class="project-image" href="<?php the_permalink($project); ?>" style="background: url('<?php $thumb = get_the_post_thumbnail_url($project,'medium'); echo $thumb; ?>') no-repeat center center/cover;"></a>
                                            <?php endif; ?>
                                            <a href="<?php the_permalink($project); ?>"><?php $title = get_the_title($project); echo $title; ?></a>
                                            <div class="subtitle"><?php the_field('subtitle',$project);?> </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div id="news">
                        <?php
                        if(get_field('news')):
                            $news_category_id = get_field('news');
                            $args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'cat' => $news_category_id
                            );
                            $query = new WP_Query( $args );
                            if( $query->have_posts() ) :
                                ?><h2>News</h2><?php
                                while( $query->have_posts() ): $query->the_post();
                                ?>
                                <div class="news">
                                    <a href="<?php the_permalink(); ?>"><?php $title =  get_the_title(); echo $title; ?></a>
                                    <div>
                                    <?php the_excerpt();?>
                                    </div>
                                    <a class="arrow" href="<?php the_permalink(); ?>">Mehr</a>
                                </div>
                                <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-4 sidebar">
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
                        <?php
                    }?>
                </ul>
                <h3>Kontakt Adresse</h3>
                <?php the_field('contact_info',$page_id);?>
                <div id="green-map" class="<?php if(get_field('color')){ $color = get_field('color'); echo $color;} ?>">
                    <h3>Anfahrt</h3>
                    <a class="arrow" href="<?php the_field('map_link',$page_id); ?>" target="_blank">Karte</a>
                </div>
                <?php if(get_field('contact_info_2',$page_id)):?>
                <?php the_field('contact_info_2',$page_id);?>
                <div id="green-map" class="<?php if(get_field('color')){ $color = get_field('color'); echo $color;} ?>">
                    <h3>Anfahrt</h3>
                    <a class="arrow" href="<?php the_field('map_link_2',$page_id); ?>" target="_blank">Karte</a>
                </div>
                <?php endif;?>
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
                $('#about-us-top').css('opacity','1');
                
            }
        })();
    });
    </script>
<?php get_footer();?>
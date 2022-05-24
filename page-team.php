<?php
/*
Template name: Team
*/
get_header();?>
	<div id="content" class="container page-team">
        <div class="megaoverlay"></div>
        <div id="members-top" class="row">
            <div class="col-8">
                <h1 class="a-hidden"><?php the_title();?></h1>
                <?php the_content();?>
            </div>
        </div>
        <div id="members-filters" class="row">
            <div class="col-8">
                <div class="row">
                    <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter-members">
                        <div class="col-6">
                            <div id="filter-departments">
                                <h3>Fachbereiche</h3>
                                <?php
                                $field_key = "department";
                                $field = get_field_object($field_key,66);
                                if( $field )
                                {
                                    foreach( $field['choices'] as $k => $v )
                                    {
                                        echo '<div class="filter-row">
                                        <input type="checkbox" id="'.$v.'" value="'.$k.'" name="department[]">
                                        <label for="'.$v.'">'.$v.'</label>
                                        </div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="filter-companies">
                                <h3>Firmen</h3>
                                <div class="filter-row">
                                    <input type="checkbox" id="Kost + Partner AG" value="1" name="company[]">
                                    <label for="Kost + Partner AG">Kost + Partner AG</label>
                                </div>
                                <div class="filter-row">
                                    <input type="checkbox" id="Trachsel AG" value="2" name="company[]">
                                    <label for="Trachsel AG">Trachsel AG</label>
                                </div>
                                <div class="filter-row">
                                    <input type="checkbox" id="Schubiger AG" value="3" name="company[]">
                                    <label for="Schubiger AG">Schubiger AG</label>
                                </div>
                            </div>
                            <div id="filter-positions">
                                <h3>Position</h3>
                                <div class="filter-row">
                                    <input type="checkbox" id="Geschäftsleitung" value="1" name="position">
                                    <label for="Geschäftsleitung">Geschäftsleitung</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="membersfilter">
                    </form>
                </div>
            </div>
        </div>
        <div id="members">
            <?php
                $args = array(
                'posts_per_page' => -1,
                'post_type' => 'member',
                'post_status' => 'publish',
                //'orderby' => 'wpse_last_word',
                'meta_key' => 'last_name',
                'orderby' => 'meta_value',
                'order'     => 'ASC'
            );
            $wp_query = new WP_Query( $args );
            if($wp_query->have_posts()){
                $i = 0;
                while($wp_query->have_posts()){ 
                    $wp_query->the_post();
                        if($i % 3 === 0) :    echo '<div class="row">'; endif; ?>
                        <?php
                        $member = get_the_ID();
                        $permalink = get_permalink($member);
                        $title = get_the_title($member);
                        $content = get_post_field('post_content', $member);
                        $image = get_the_post_thumbnail( $member, 'medium' );
                        $email = get_field('email');
                        ?>
                        <div class="col-4">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="member-info">
                                            <a class="member-name" href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
                                            <div class="member-image mobile">
                                                <a href="<?php echo esc_url( $permalink ); ?>"><?php echo $image;?></a>
                                            </div>
                                            <div><?php echo $content;?></div>
                                            <?php if($email):?>
                                            <a class="arrow" href="mailto:<?php echo $email;?>">Kontakt</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="member-image desktop">
                                            <a href="<?php echo esc_url( $permalink ); ?>"><?php echo $image;?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($i % 3 == 2): ?>
                        </div>
                        <?php endif ?>
                        <?php $i++;
                }
            }else{
            }
            wp_reset_postdata();
            ?>
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
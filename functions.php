<?php
// Enable thumbnails
add_theme_support( 'post-thumbnails' );
// Load styles and scripts
function add_theme_scripts() {
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/css/styles.css', array(), '1.1', 'all');
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array ( 'jquery' ), 1.1, true);
    wp_enqueue_script( 'animate', get_template_directory_uri() . '/js/animate.js', array ( 'jquery' ), 1.1, true);
    if ( is_singular( array( 'post', 'project' ) ) ) {
        wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '1.1', 'all');
        wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array ( 'jquery' ), 1.1, true);
        wp_enqueue_style( 'fancy', get_template_directory_uri() . '/css/fancybox.css', array(), '1.1', 'all');
        wp_enqueue_script( 'fancy', get_template_directory_uri() . '/js/fancybox.js', array ( 'jquery' ), 1.1, true);
    }
    if ( is_page_template( 'page-blog.php' ) ) {
        wp_enqueue_style( 'selectric', get_template_directory_uri() . '/css/selectric.css', array(), '1.1', 'all');
        wp_enqueue_script( 'selectric', get_template_directory_uri() . '/js/selectric.js', array ( 'jquery' ), 1.1, true);
    }
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
// Remove pagination title
function sanitize_pagination($content) {
    $content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $content);
    return $content;
}
add_action('navigation_markup_template', 'sanitize_pagination');
// Add menus
function register_my_menus() {
    register_nav_menus(
      array(
        'top-menu' => __( 'Top Menu' ),
        'header-menu' => __( 'Header Menu' ),
        'sidebar-menu' => __( 'Sidebar Menu' )
       )
    );
}
add_action( 'init', 'register_my_menus' );
// Options page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page('Header');
	acf_add_options_page('Footer');
}
// Enable SVG upload
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
// Remove tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');
// Filter projects
add_action('wp_ajax_myfilter', 'projects_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'projects_filter_function');
 
function projects_filter_function(){
	$args = array(
        'post_type' => 'project',
        'tag_id' => $_POST['categoryfilter']
	);
 
	if( isset( $_POST['categoryfilter'] ) )
	$query = new WP_Query( $args );
    if( $query->have_posts() ) :
        $count = 0;
		while( $query->have_posts() ): $query->the_post();
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
                    <a class="img" href="<?php the_permalink(); ?>" style="background: url('<?php the_post_thumbnail_url($id,'medium'); ?>') no-repeat center center / cover;"></a>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <div class="subtitle"><?php the_field('subtitle',$id);?></div>
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
        endwhile;
        wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
 
	die();
}
// Filter blogs
add_action('wp_ajax_blogfilter', 'blogs_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_blogfilter', 'blogs_filter_function');
 
function blogs_filter_function(){
	$args = array(
        'paged' => $paged,
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'category_name' => $_POST['blog-cat'],
        'date_query' => array(
            array(
                'year' => $_POST['blog-year'],
                'month' => $_POST['blog-month']
            ),
        ),
	);
 
	if( isset( $_POST['blog-year'] ) )
	$query = new WP_Query( $args );
    if( $query->have_posts() ) :
		while( $query->have_posts() ): $query->the_post();
        ?>
        <div class="news">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <div class="news-date"><?php the_time('d. M. Y');?></div>
            <div><?php 
            if(get_field('teaser')){
                the_field('teaser');
            }else{
                the_excerpt();
            }
            ?>
            </div>
            <a class="arrow" href="<?php the_permalink(); ?>">Mehr</a>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
 
	die();
}
// Filter members
add_action('wp_ajax_membersfilter', 'members_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_membersfilter', 'members_filter_function');
 
function members_filter_function(){
    if(!empty($_POST['department'])){
        $departments = $_POST['department'];
        $department_query = array('relation' => 'OR');
        foreach( $departments as $department ){
            $department_query[] = array(
                'key'     => 'department',
                'value'   => '"'.$department.'"',
                'compare' => 'LIKE'
            );
        }
    }
    if(!empty($_POST['company'])){
        $companies = $_POST['company'];
        $company_query = array('relation' => 'OR');
        foreach( $companies as $company ){
            $company_query[] = array(
                'key'     => 'company',
                'value'   => $company,
                'compare' => '='
            );
        }
    }
    if(!empty($_POST['position'])){
        $position = $_POST['position'];
        $position_query =  array(
            'key'     => 'position',
            'value'   => $position,
            'compare' => '='
        );
    } 
    

	$args = array(
        'posts_per_page' => -1,
        'post_type' => 'member',
        'post_status' => 'publish',
        //'orderby' => 'wpse_last_word',
        'meta_key' => 'last_name',
        'orderby' => 'meta_value',
        'order'     => 'ASC',
        'meta_query' => array(
            'relation' => 'AND',
            $department_query,
            $company_query,
            $position_query
        )
	);

    if(empty($_POST['department'])&&!empty($_POST['company'])&&!empty($_POST['position'])){
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'member',
            'post_status' => 'publish',
            //'orderby' => 'wpse_last_word',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'order'     => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                $company_query,
                $position_query
            )
        );
    }

    if(!empty($_POST['department'])&&empty($_POST['company'])&&!empty($_POST['position'])){
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'member',
            'post_status' => 'publish',
            //'orderby' => 'wpse_last_word',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'order'     => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                $department_query,
                $position_query
            )
        );
    }

    if(!empty($_POST['department'])&&!empty($_POST['company'])&&empty($_POST['position'])){
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'member',
            'post_status' => 'publish',
            //'orderby' => 'wpse_last_word',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'order'     => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                $department_query,
                $company_query
            )
        );
    }

    if(!empty($_POST['department'])&&empty($_POST['company'])&&empty($_POST['position'])){
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'member',
            'post_status' => 'publish',
            //'orderby' => 'wpse_last_word',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'order'     => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                $department_query
            )
        );
    }

    if(empty($_POST['department'])&&!empty($_POST['company'])&&empty($_POST['position'])){
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'member',
            'post_status' => 'publish',
            //'orderby' => 'wpse_last_word',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'order'     => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                $company_query
            )
        );
    }

    if(empty($_POST['department'])&&empty($_POST['company'])&&!empty($_POST['position'])){
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'member',
            'post_status' => 'publish',
            //'orderby' => 'wpse_last_word',
            'meta_key' => 'last_name',
            'orderby' => 'meta_value',
            'order'     => 'ASC',
            'meta_query' => array(
                'relation' => 'AND',
                $position_query
            )
        );
    }

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
                                <div><?php echo $content; ?></div>
                                <?php if($email):?>
                                <a class="arrow" href="mailto:<?php echo $email;?>">Kontakt</a>
                                <?php endif; ?>
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
            <?php if($i % 3 == 2): ?>
            </div>
            <?php endif ?>
            <?php $i++;
        }
    }
    wp_reset_postdata();
	die();
}
// Order by second word (last name)
add_filter( 'posts_orderby', function( $orderby, \WP_Query $q )
{
    if( 'wpse_last_word' === $q->get( 'orderby' ) && $get_order =  $q->get( 'order' ) )
    {
        if( in_array( strtoupper( $get_order ), ['ASC', 'DESC'] ) )
        {
            global $wpdb;
            $orderby = " SUBSTRING_INDEX( {$wpdb->posts}.post_title, ' ', -1 ) " . $get_order;
        }
    }
    return $orderby;
}, PHP_INT_MAX, 2 );
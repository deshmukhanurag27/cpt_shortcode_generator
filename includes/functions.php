<?php
if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Add Image Size to set thumbnail size
 */
add_image_size( 'ad-cpts-image', 240, 157, true );

/**
 * Instead of calling get_the_content(), call this function instead, and it'll all be good
 */
function ad_cpts_get_formatted_content()
{
	ob_start();
	the_content();
	$the_content = ob_get_contents();
	ob_end_clean();
	return $the_content;
}

/*
	*Add shortcode
*/
add_shortcode('cpt_list','ad_cpts_display_cpt_list');

function ad_cpts_display_cpt_list($atts)
{

	$attr = shortcode_atts( array(
        'cpt_name' 		 => '',
		'thumbnail' 	 => '',
		'pagination' 	 => '',
		'posts_per_page' => '',
		'class_name' 	 => '',
		'read_more' 	 => ''
    ), $atts, 'cpt_list' );	

	$cpt_name = $attr['cpt_name'];
	$thumbnail = $attr['thumbnail'];
	$pagination = $attr['pagination'];	
	$class_name = $attr['class_name'];
	$read_more = $attr['read_more'];
	if ($attr['posts_per_page'] == '') {
		$posts_per_page = -1;
	} else {
		$posts_per_page = $attr['posts_per_page'];
	}

	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	$args = array(
				'post_type'		  => $cpt_name,
				'posts_per_page'  => $posts_per_page,
			);
	if ('yes' == $pagination) {
		$args['paged'] = $paged;
	}
	$query = new WP_Query( $args );
	global $post;
	ob_start();
	?>

	<div class="<?php $class_name; ?>" id="display_cpt_listing">
	    <div class="cpts_list clearfix">
	    	<?php
	    		if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
					$post_content = ad_cpts_get_formatted_content();
					$post_trimmed = substr($post_content, 0, strpos($post_content, ' ', 300));
	    	?>
	        <div class="cpts_indi_list clearfix">
	        	<?php
	        		if ( 'yes' == $thumbnail ) {
	        	?>
	        	<div class="cpts_img">
	        		<?php
	        			if ( has_post_thumbnail() ) {
	        				esc_url(the_post_thumbnail( 'ad-cpts-image' ));
	        			}
	                	else {
	                		$no_image = esc_url(AD_CPTS_BASE_URI.'assets/images/cpts-no-image.jpg');
	                		?>
	                		<img src="<?php echo $no_image; ?>">
	                		<?php	
	                	} 
	                ?>
	            </div>
	        	<?php
	        		}
	        	?>
	            <div class="cpts_text">      
	                <a href="<?php esc_url(the_permalink()); ?>">
	                	<h2><?php the_title(); ?></h2>
	                </a>
	                <?php echo $post_trimmed.' ...';
	                	if ('yes' == $read_more) {
	                ?>
	                	<a class="cpts-link" href="<?php esc_url(the_permalink()); ?>">Read More</a>
	                <?php
	                	}
	                ?>
	            </div>
	        </div>
	        <?php
	        	endwhile; endif;
    			// Set the pagination args.
			    $paginateArgs = array(
			        'format'  => '?paged=%#%',
			        'current' => $paged, // Reference the custom paged query we initially set.
			        'total'   => $query->max_num_pages // Max pages from our custom query.
			    );
			    $html = paginate_links( $paginateArgs );
			?>	
	        <div class="cpts-pagination">
	            <?php echo paginate_links( $paginateArgs ); ?>
	        </div>
	    </div>
	</div>
<?php	
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
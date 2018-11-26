<?php 

/*
================================================
Add/Enqueue Storefront child styles and scripts
================================================
*/

function storefront_child_styles_scripts() {
	
	//Enqueue parent stylesheet
	wp_enqueue_style('storefront-style', get_template_directory_uri().'/style.css');

	//enqueue theme css
	wp_enqueue_style('storefront-child-style', get_stylesheet_directory_uri().'/style.css');
}

add_action('wp_enqueue_scripts', 'storefront_child_styles_scripts');


/*
================================================
Hide category product count in product archives
================================================
 */
add_filter( 'woocommerce_subcategory_count_html', '__return_false' );


/*
================================================
Add custom before contentslider
================================================
*/

function child_theme_init() {
		add_action ('storefront_before_content', 'slider', 5);
	}

function slider() {
	if (is_page(43)) {
		?> 
			<div class="slider"><?php dynamic_sidebar( 'content-slider' ); ?></div>
		<?php
	}
}

add_action ( 'init', 'child_theme_init' );

/*
================================================
Add a Description Below Homepage Section Title
================================================
*/
add_action('storefront_homepage_after_featured_products_title', 'custom_storefront_product_featured_description');
 
function custom_storefront_product_featured_description(){ ?>
 <p class="element-title--sub">
    <?php echo "Section description here";?>
  </p>
<?php }


/*
================================================
Add custom before footer
================================================
*/

function storefront_child_before_footer() {
	add_action ('storefront_before_footer', 'call_action');
}

function call_action() {
	?>
		<div class="col-full"><?php dynamic_sidebar( 'content-child-4' ); ?></div>
	<?php
}

add_action ( 'init', 'storefront_child_before_footer' );


/*
================================================
Add custom footer credit
================================================
*/

function storefront_child_remove_storefront_footer_credit() {
	//remove
	remove_action ( 'storefront_footer', 'storefront_credit', 20 );
	//call
	add_action ('storefront_footer', 'storefront_child_custom_footer_credit', 20 );
}

function storefront_child_custom_footer_credit() 
{
	?>
		<div class="site-info" style="text-align: center;">

			<div class="col-full content-child-1">
				<?php dynamic_sidebar( 'content-child-1' ); ?>
			</div>

			<div class="col-full content-child-2">
				<?php dynamic_sidebar( 'content-child-2' ); ?>
			</div>

			<?php echo '<div class="copy">' . esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; 2017 - ' . date( 'Y')  . ' ' . get_bloginfo( 'name' ) ) ) . '</div>' ; ?>

			<?php if ( apply_filters( 'storefront_credit_link', true ) ) 
				{ ?>

					<div class="col-full content-child-3">
						<?php dynamic_sidebar( 'content-child-3' ); ?>
					</div>

					<?php
						if ( apply_filters( 'storefront_privacy_policy_link', true ) && function_exists( 'the_privacy_policy_link' ) ) 
						{
							//the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
						}
					?>

					<?php //echo '<a href="https://woocommerce.com" target="_blank" title="' . esc_attr__( 'WooCommerce - The Best eCommerce Platform for WordPress', 'storefront' ) . '" rel="author">' . esc_html__( 'Built with Storefront &amp; WooCommerce', 'storefront' ) . '</a>.' ?>
				
				<?php } 
			?>
		</div><!-- .site-info -->
	<?php
}

add_action ( 'init', 'storefront_child_remove_storefront_footer_credit', 20 );


/*
================================================
Register custom widget area.
================================================
*/

/* Register our sidebars and widgetized areas */
function register_storefront_child_widgets() {
	
	register_sidebar( array(
		'id'          => 'content-slider',
		'name'        => __( 'Content Slider', 'storefront' ),
		'description' => __( 'Widgets added to this region will appear beneath the main content and above the footer content.', 'storefront' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="gamma widget-title">',
		'after_title'   => '</span>',
	) );

	register_sidebar( array(
		'id'          => 'content-child-1',
		'name'        => __( 'Footer Below Content Child 1', 'storefront' ),
		'description' => __( 'Widgets added to this region will appear beneath the main content and above the footer content.', 'storefront' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="gamma widget-title">',
		'after_title'   => '</span>',
	) );

	register_sidebar( array(
		'id'          => 'content-child-2',
		'name'        => __( 'Footer Below Content Child 2', 'storefront' ),
		'description' => __( 'Widgets added to this region will appear beneath the main content and above the footer content.', 'storefront' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="gamma widget-title">',
		'after_title'   => '</span>',
	) );

	register_sidebar( array(
		'id'          => 'content-child-3',
		'name'        => __( 'Footer Below Content Child 3', 'storefront' ),
		'description' => __( 'Widgets added to this region will appear beneath the main content and above the footer content.', 'storefront' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="gamma widget-title">',
		'after_title'   => '</span>',
	) );

	register_sidebar( array(
		'id'          => 'content-child-4',
		'name'        => __( 'Below Content Child 4', 'storefront' ),
		'description' => __( 'Widgets added to this region will appear beneath the main content and above the footer content.', 'storefront' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<span class="gamma widget-title">',
		'after_title'   => '</span>',
	) );
}

add_action( 'widgets_init', 'register_storefront_child_widgets' );

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('storefront_product_categories_args','child_storefront_product_categories_custom_args', 199);
 
function child_storefront_product_categories_custom_args( $args ) {
$custom_limit_count = 20; // change this number for needs
$args['limit'] = $custom_limit_count; 
return $args;
}



/** Remove categories from shop and other pages
 * in Woocommerce
 */
function wc_hide_selected_terms( $terms, $taxonomies, $args ) {
    $new_terms = array();
    if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && is_page(43) ) {
        foreach ( $terms as $key => $term ) {
              if ( ! in_array( $term->slug, array( 'niet-gebruiken' ) ) ) {
                $new_terms[] = $term;
              }
        }
        $terms = $new_terms;
    }
    return $terms;
}
add_filter( 'get_terms', 'wc_hide_selected_terms', 10, 3 );

?>
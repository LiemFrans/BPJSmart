<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package eCommerce_lite
 */

/*-------eCommerce Lite Theme Woocommerce Functions----------*/
	/* Contents:
		1.  eCommerce Lite Woocommerce Products Item 
		2.  eCommerce Lite Disable the default WooCommerce stylesheet.
		3.  eCommerce Lite WooCommerce setup function. 
		4.	eCommerce Lite WooCommerce specific scripts & stylesheets.	
		5.	eCommerce Lite Add 'woocommerce-active' class to the body tag.
		6.	eCommerce Lite Products per page.
		7.	eCommerce Lite Product gallery thumnbail columns.
		8.	eCommerce Lite Default loop columns on product archives.
		9.	eCommerce Lite  Related Products Args.
		10.	eCommerce Lite  Woocommerce Header Cart 
		11.	eCommerce Lite Woocommerce Cart Links
		12.	eCommerce Lite Cart Fragments.
		13.	eCommerce Lite Header User Section
		14.	eCommerce Lite Woocommerce Social Share
		15.	eCommerce Lite Woocommerce Products Discount Show
		16.	eCommerce Lite Product columns wrapper.
		17.	eCommerce Lite  Product columns wrapper close.
		18.	eCommerce Lite Header Wishlist
		19.	eCommerce Lite Woocommerce Rating Section
		20.	eCommerce Lite Woocommerce Quick View 
		21.eCommerce Lite Woocommerce Compare List
		22.eCommerce Lite Woocommerce Compare Product
		23.eCommerce Lite Add To Cart Button Text Change
	*/


//Single Page 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );



/** Woocommerce Products Item */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

$eCommerce_lite_Woocommerce = new eCommerce_lite_Woocommerce();
add_action( 'woocommerce_before_shop_loop_item',array( $eCommerce_lite_Woocommerce,'ecommerce_lite_woocommerce_before_shop_loop_item'), 10 );


//single page social Share
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
add_action( 'woocommerce_single_product_summary',array( $eCommerce_lite_Woocommerce,'ecommerce_lite_social_share'), 50 );


/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


class eCommerce_lite_Woocommerce{
	
	public function __construct(){
		//eCommerce Woocommerce Add Actions
		add_action( 'after_setup_theme',array($this,'ecommerce_lite_woocommerce_setup')  );
		add_action( 'wp_enqueue_scripts',array($this,'ecommerce_lite_woocommerce_scripts') );
	
		//eCommerce Lite Filter
		add_filter( 'body_class',array($this,'ecommerce_lite_woocommerce_active_body_class') );
		add_filter( 'loop_shop_per_page',array($this,'ecommerce_lite_woocommerce_products_per_page') );
		add_filter( 'woocommerce_product_thumbnails_columns',array($this,'ecommerce_lite_woocommerce_thumbnail_columns')  );
		add_filter( 'loop_shop_columns',array($this,'ecommerce_lite_woocommerce_loop_columns') );
		add_filter( 'woocommerce_output_related_products_args',array($this,'ecommerce_lite_woocommerce_related_products_args') );
		add_filter( 'woocommerce_add_to_cart_fragments',array($this,'ecommerce_lite_woocommerce_cart_link_fragment') );

		//Add to cart Text
		add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            // 
		add_filter( 'woocommerce_product_add_to_cart_text',array($this,'woo_custom_ecommerce_lite_woocommerce_product_add_to_cart_text') );  // Add to Cart
		
	}

	/**
	 * 3.eCommerce Lite WooCommerce setup function.
	 *
	 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
	 *
	 * @return void
	 */
	function ecommerce_lite_woocommerce_setup() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}


	/**
	 * 4.eCommerce Lite WooCommerce specific scripts & stylesheets.
	 *
	 * @return void
	 */
	function ecommerce_lite_woocommerce_scripts() {
		wp_enqueue_style( 'ecommerce-lite-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

		$font_path   = WC()->plugin_url() . '/assets/fonts/';
		$inline_font = '@font-face {
				font-family: "star";
				src: url("' . $font_path . 'star.eot");
				src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
					url("' . $font_path . 'star.woff") format("woff"),
					url("' . $font_path . 'star.ttf") format("truetype"),
					url("' . $font_path . 'star.svg#star") format("svg");
				font-weight: normal;
				font-style: normal;
			}';

		wp_add_inline_style( 'ecommerce-lite-woocommerce-style', $inline_font );
	}



	/**
	 * 5.eCommerce Lite Add 'woocommerce-active' class to the body tag.
	 *
	 * @param  array $classes CSS classes applied to the body tag.
	 * @return array $classes modified to include 'woocommerce-active' class.
	 */
	function ecommerce_lite_woocommerce_active_body_class( $classes ) {
		$classes[] = 'woocommerce-active';

		return $classes;
	}


	/**
	 * 
	 * 6.eCommerce Lite Products per page.
	 *
	 * @return integer number of products.
	 */
	function ecommerce_lite_woocommerce_products_per_page() {
		$ecommerce_lite_woocommerce_products_per_page = get_theme_mod('ecommerce_lite_woocommerce_products_per_page',12);
		return $ecommerce_lite_woocommerce_products_per_page;
	}



	/**
	 * 7.eCommerce Lite Product gallery thumnbail columns.
	 *
	 * @return integer number of columns.
	 */
	function ecommerce_lite_woocommerce_thumbnail_columns() {
		$ecommerce_lite_woocommerce_thumbnail_columns = get_theme_mod('ecommerce_lite_woocommerce_thumbnail_columns',4);
		return $ecommerce_lite_woocommerce_thumbnail_columns;
	}

	/**
	 * 8.eCommerce Lite Default loop columns on product archives.
	 *
	 * @return integer products per row.
	 */
	function ecommerce_lite_woocommerce_loop_columns() {
		$ecommerce_lite_woocommerce_loop_columns = get_theme_mod('ecommerce_lite_woocommerce_loop_columns',3);
		return $ecommerce_lite_woocommerce_loop_columns;
	}


	/**
	 *9.eCommerce Lite  Related Products Args.
	 *
	 * @param array $args related products args.
	 * @return array $args related products args.
	 */
	function ecommerce_lite_woocommerce_related_products_args( $args ) {
		//Argument Customizer Value
		$ecommerce_lite_woocommerce_related_products_posts_per_page = get_theme_mod('ecommerce_lite_woocommerce_related_products_posts_per_page',3);
		$ecommerce_lite_woocommerce_related_products_columns = get_theme_mod('ecommerce_lite_woocommerce_related_products_columns',3);
		
		$defaults = array(
			'posts_per_page' => $ecommerce_lite_woocommerce_related_products_posts_per_page,
			'columns'        => $ecommerce_lite_woocommerce_related_products_columns,
		);

		$args = wp_parse_args( $defaults, $args );

		return $args;
	}





	
	/** 10.eCommerce Lite  Woocommerce Header Cart */

	public function ecommerce_lite_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		global $woocommerce;
		
		?>
		<li>
			<div class="header-cart" id="cart">
				<div class="mini-cart">
					<div class="<?php echo esc_attr($class); ?>">
						<?php $this->ecommerce_lite_woocommerce_cart_link(); ?>
					</div>
					<div id="top-add-cart">
						<div class="top-cart-content">
							<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
						</div>
					</div>
				</div>
			</div>
		</li>
		<?php 
	}



	
	/** 11.eCommerce Lite Woocommerce Cart Links */
	function ecommerce_lite_woocommerce_cart_link() {
		?>
		<div id="cart_new">
			<a href="">
				<i class="fa fa-shopping-cart" aria-hidden="true"></i>
				<span><?php echo intval(WC()->cart->get_cart_contents_count()); ?></span>
			</a>
		</div>
		<?php
	}



	
	/**
	 *12.eCommerce Lite Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function ecommerce_lite_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		$this->ecommerce_lite_woocommerce_cart_link();
		$fragments['#cart_new'] = ob_get_clean();

		return $fragments;
	}

	


	/** 13.eCommerce Lite Header User Section */
	public function ecommerce_lite_woocommerce_user_login(){
		?>
		<?php if (is_user_logged_in()) { ?>	
			
			<!-- User LogOut Section -->
			<li id="header-login" class="login">
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
					<i class="fa fa-user"></i><?php echo esc_html_e('Account','ecommerce-lite'); ?>
				</a>
			</li>

		<?php } else{ ?>
			<!-- User Login Section -->
			<li id="header-login">
				<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="clearfix">
					<i class="fa fa-lock"></i><?php echo esc_html_e('Login','ecommerce-lite'); ?>
				</a>
			</li>
	
		<?php } 
	}


	

	
	/** 14.eCommerce Lite Woocommerce Social Share */

	public function ecommerce_lite_social_share() {
		if( get_theme_mod('ecommerce_lite_social_share_enable',true) == true ){

			//Woocommerce eCommerce Lite Args
			$single_page_id = get_the_ID();
			$single_page_url = get_the_permalink( $single_page_id );
			$single_page_title = get_the_title( $single_page_id );
			$single_page_desc = get_the_excerpt( $single_page_id );
		?>
			<div class="social-icon clearfix">
				<span><?php esc_html_e('Share This :','ecommerce-lite'); ?></span>
				<ul>
					<li>
						<!-- Email -->
						<a href="mailto:?Subject=<?php echo esc_attr( $single_page_title ); ?>&amp;Body=<?php echo esc_attr( $single_page_desc ); ?> <?php echo esc_url( $single_page_url ); ?>">
							<i class="fa fa-envelope"></i>
						</a>
					</li>
					<li><!-- Facebook -->
						<a href="<?php echo esc_url('http://www.facebook.com/sharer.php?u='.$single_page_url); ?>" target="_blank">
							<i class="fa fa-facebook-f"></i>
						</a>
					</li>
						
					<li><!-- Twitter -->
						<a href="<?php echo esc_url('https://twitter.com/share?url='.$single_page_url); ?>&amp;text=<?php echo esc_attr($single_page_title); ?>&amp;hashtags=simplesharebuttons" target="_blank">
							<i class="fa fa-twitter"></i>
						</a>
					</li>

					<li><!-- Google+ -->
						<a href="<?php echo esc_url('https://plus.google.com/share?url='.$single_page_url); ?>" target="_blank">
							<i class="fa fa-google-plus" aria-hidden="true"></i>
						</a>
					</li>
				</ul>  
			</div>
		<?php 
		}

	}



	

	/** 15.eCommerce Lite Woocommerce Products Discount Show */
	function ecommerce_lite_sale_percentage_loop() {
		global $product;
		
		if ( $product->is_on_sale() ) {
			
			if ( ! $product->is_type( 'variable' ) and $product->get_regular_price() and $product->get_sale_price() ) {
				$max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
			} else {
				$max_percentage = 0;
				
				foreach ( $product->get_children() as $child_id ) {
					$variation = wc_get_product( $child_id );
					$price = $variation->get_regular_price();
					$sale = $variation->get_sale_price();
					$percentage = '';
					if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
				}
			
			}
			
			echo "<div class='ribbon label-52'><span>" . esc_attr( round($max_percentage) ) . "%  OFF</span></div>";
		
		}

	}

	/** 18.eCommerce Lite Header Wishlist  */
	public function ecommerce_lite_top_wishlist() {
		if (!defined( 'YITH_WCWL' )) return;
		?>
		<li id="header-wishlist" class="cart">
			<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url()); ?>">
				<i class="fa fa-heart"></i>
				<span class="wishlist-count">
					<?php 
						$wishlist_count = YITH_WCWL()->count_products();
						echo esc_html( $wishlist_count ); 
					?>
				</span>
			</a>
		</li>
		<?php 
	}



	/** 19.eCommerce Lite Woocommerce Rating Section  */
	public function ecommerce_lite_get_star_rating(){
	    global $woocommerce, $product;
	    $average = $product->get_average_rating();
		?>
		<div class="rating" itemscope itemtype="http://schema.org/AggregateRating">
			<?php
				//Rating Loop 
				for( $i = 1; $i<=5; $i++ ) {
					if ($i<=$average){
						echo '<i class="fa fa-star gold"></i>';
					}
					else{ 
						echo '<i class="fa fa-star black"></i>';
					} 
				} 
			?>
		</div>
		<?php
	}



	/** 20.eCommerce Lite Woocommerce Quick View */
	public function ecommerce_lite_product_quickview(){
		if ( !defined( 'YITH_WCQV' )) return;

        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, '_add_quick_view_button' ), 15 );
		echo '
			<a title="'. esc_html( 'Quick View', 'ecommerce-lite' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . get_the_ID() . '">
				<i class="fa fa-eye"></i>
			</a>	
			';

	}



	/** 21.eCommerce Lite Woocommerce Compare List  */
	public function ecommerce_lite_wishlist_products() {
		if ( !defined( 'YITH_WCWL' )) return;
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->get_id() );
			$id				 = $product->get_id();
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
			?>  
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">

				<div class="yith-wcwl-add-button show" style="display:block">  
					<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" class="add_to_wishlist">
						<i class="fa fa-heart"></i>
					</a>
				</div>

				<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> 
					<a href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-check" aria-hidden="true"></i></a>
				</div>

				<div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
					<span class="feedback"><?php esc_html_e( 'The product is already in the wishlist!', 'ecommerce-lite' ); ?></span>
				</div>

				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>

			</div>
		<?php
	}



	
	/** 22.eCommerce Lite Woocommerce Compare Product */
	
	function ecommerce_lite_add_compare_link( $product_id = false, $args = array() ) {
		if ( !defined( 'YITH_WOOCOMPARE' )) return;
		extract( $args );

		if ( ! $product_id ) {
			global $product;
			$productid = $product->get_id();
			$product_id = isset( $productid ) ? $productid : 0;
		}
		
		$is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

		if ( ! isset( $button_text ) || $button_text == 'default' ) {
			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'ecommerce-lite' ) );
			yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
			$button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
		}
		printf( '<a title="'. esc_html__( 'Add to Compare', 'ecommerce-lite' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><span><i class="fa fa-exchange"></i></span>', '#', 'compare', intval($product_id));
	}	



	
	/** 22.eCommerce Lite Woocommerce Shop Products Loop */
	function ecommerce_lite_woocommerce_before_shop_loop_item(){
		//woocommerce Add To Cart Object	item
		global $product;
		?>
		<div class="reveal">
			<?php  

				global $post, $product; 

				//Featured Products Display
				if( $product->is_featured() ){
					echo '<div class="featured ribbon"><span class="featured-products">Featured</span></div>';
				}

				$this->ecommerce_lite_sale_percentage_loop();#products Loop

				the_post_thumbnail('woocommerce_thumbnail'); #Products Thumbnail 
			?>
			
			<div class="hidden">
				<?php  
				
					//Second Thumbnail Images
					$attachment_ids = $product->get_gallery_image_ids();
					if ( $attachment_ids ) {
						echo wp_get_attachment_image( $attachment_ids[0], apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ), false, array('class'=>'secondary_image') );
					}else{
						echo ''.$product->get_image('shop_catalog', array('class'=>'primary_image'));
					}
					
				?>
				<div class="cart-icon">
					<?php 
						$this->ecommerce_lite_add_compare_link();
						$this->ecommerce_lite_wishlist_products();
						$this->ecommerce_lite_product_quickview(); 
					?>
					<div class="addcart">
						<?php woocommerce_template_loop_add_to_cart(); #Button Cart ?>
					</div>
				</div>
			</div>
		</div>
		<div class="product-detail">
			<div class="clearfix">
				<div class="product-title">
					<h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
				</div>
			</div>
			<div class="clearfix">
			<div class="price red">
				<?php  woocommerce_template_loop_price();#Woocommerce Template loop Price ?>
			</div>
			<?php $this->ecommerce_lite_get_star_rating(); ?>
			</div>
		</div>
		
		<?php  
	}



	/** 22.eCommerce Lite Woocommerce Breadcrumb Section */
	function ecommerce_lite_woocommerce_breadcrumb(){
		ecommerce_lite_breadcrumb(); //breadcrumbs Section 
	}




	
	/** 22.eCommerce Lite Add To Cart Button Text Change */
	 function woo_custom_ecommerce_lite_woocommerce_product_add_to_cart_text() {
		$ecommerce_lite_store_woocommerce_addtocart_text = get_theme_mod( 'ecommerce_lite_store_woocommerce_addtocart_text',' Add To Cart' );
		return $ecommerce_lite_store_woocommerce_addtocart_text;
	
	}
	


}
new eCommerce_lite_Woocommerce();


//woocommmerce category id find
function  ecommerce_lite_woo_cat_id_by_slug( $slug ){
	$term = get_term_by('slug', $slug, 'product_cat', 'ARRAY_A');
	return $term['term_id'];       
}
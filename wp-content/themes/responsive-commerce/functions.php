<?php

/**
 * Load css files.
 * @return [type] [description]
 */
function responsive_commerce_enqueue_style() {
	// Load main css file of parent theme.
    wp_enqueue_style( 'di-business-style-default', get_template_directory_uri() . '/style.css' );

    // Load this child theme css after all parent css files.
    wp_enqueue_style( 'responsive-commerce-style',  get_stylesheet_directory_uri() . '/style.css', array( 'bootstrap', 'font-awesome', 'di-business-style-default', 'di-business-style-core' ), wp_get_theme()->get('Version'), 'all');
}
add_action( 'wp_enqueue_scripts', 'responsive_commerce_enqueue_style' );

// Product rotation options.
add_action( 'di_business_woo_options', 'responsive_commerce_woo_options_rc' );
function responsive_commerce_woo_options_rc() {

	Kirki::add_field( 'di_business_config', array(
		'type'			=> 'toggle',
		'settings'		=> 'prod_img_rotate',
		'label'			=> esc_attr__( 'Rotate Product Image?', 'responsive-commerce' ),
		'description'	=> esc_attr__( 'Enable/Disable rotation of product images on shop page.', 'responsive-commerce' ),
		'section'		=> 'woocommerce_options',
		'default'		=> '1',
	) );

	Kirki::add_field( 'di_business_config', array(
		'type'        => 'color',
		'settings'    => 'product_border_color',
		'label'       => esc_attr__( 'Product Border Color', 'responsive-commerce' ),
		'section'     => 'woocommerce_options',
		'default'     => '#a0ce4e',
		'choices'     => array(
			'alpha' => true,
		),
		'output' => array(
			array(
				'element'  => '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
				'property' => 'box-shadow',
				'prefix'	=> '0px 0px 2px 1px ',
			),
			array(
				'element'  => '.woocommerce ul.products li.product:hover, .woocommerce-page ul.products li.product:hover',
				'property' => 'box-shadow',
				'prefix'	=> '0px 0px 6px 1px ',
			),
		),
		'transport' => 'auto',
	) );
}

// Product rotation options handle.
add_action( 'wp_enqueue_scripts', 'responsive_commerce_inline_css' );
function responsive_commerce_inline_css() {
	$custom_css = "";
	if( get_theme_mod( 'prod_img_rotate', '1' ) ) {
		$custom_css .= "
		.woocommerce ul.products li.product:hover img, .woocommerce-page ul.products li.product:hover img {
			-ms-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		";
	}
	wp_add_inline_style( 'responsive-commerce-style', $custom_css );
}



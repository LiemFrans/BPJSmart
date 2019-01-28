<?php
/*
Plugin Name: Billingotomatis - Woocommerce, payment gateway
Plugin URI: http://billingotomatis.com
Description: Dengan plugin ini Anda bisa menggunakan pembayaran lewat Bank BCA, Bank Mandiri, Bank BNI, Bank BRI, dan Bank BSM secara otomatis dengan Woocommerce. Ingin lebih? Anda juga bisa memanfaatkan Billingotomatis SMS gateway untuk toko online (woocomerce) Anda.
Author: BillingOtomatis.com
Version: 20190111
WC requires at least: 3.0.0
WC tested up to: 3.5.3
*/
if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
include_once(dirname(__FILE__)."/functions.php");


function bilo_woo_subscriptio_created_renewal_order_hook($subscription, $order_id) {
  bilo_woo_new_order_hook($order_id);
}
add_action('subscriptio_created_renewal_order', 'bilo_woo_subscriptio_created_renewal_order_hook',50,2);

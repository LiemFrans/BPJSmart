=== Billingotomatis - Woocommerce, payment gateway ===
Contributors: ahlul
Donate link:
Tags: payment gateway, indonesia, woocomerce, bca, mandiri, bsm, bni, bri, otomatis, mutasi, billingotomatis
Requires at least: 3.0.1
Tested up to: 5.0.3
Stable tag: 20190111
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Module ini adalah addon dari billingotomatis gateway sebagai payment gateway woocomerce wordpress.

== Description ==

Billingotomatis.com merupakan penyedia layanan pengecekan mutasi ke bank-bank poluler seperti: BCA, MANDIRI, BSM, BNI, BRI, BNI (dan terus berkembang).

Billingotomatis.com sudah dipercaya oleh banyak dipakai terutama oleh pebisnis online bertahun-tahun karena terbukti mempermudah pengecekan mutasi, dan melakukan otomatis transaksi.

Sudah jutaan menit yang telah dihemat oleh billingotomatis.com :)

Kenapa billingotomatis? Karena sistem billingotomatis membuat pengeluaran Anda jauh lebih kecil dibandingkan memakai payment gateway lainnya yang ber basis biaya pertransaksi.
Dan pembayaran langsung masuk ke rekening Anda, tanpa perantara.

Module ini adalah module yang bisa digunakan sebagai payment gateway woocomerce sehingga dapat menghubungkan woocomerce anda dan layanan billingotomatis.com

Dengan terhubungnya woocomerce ke billingotomatis, dapat mengotomatiskan proses pembayaran order Anda.

Billingotomatis Woocomerce juga bekerja walaupun Mata Uang WooCommerce Anda tidak memakai Rupiah (IDR).

== Installation ==

Sebelum memakai plugin ini pastikan Anda telah memiliki ioncube terinstall pada module PHP Anda.

Pastikan Anda sudah menginstall Billingotomatis Payment Gateway sebelum menginstall plugin ini.
Pluginnya bisa di download atau diinstall dari:
https://wordpress.org/plugins/billingotomatis-payment-gateway-indonesia/

== Frequently Asked Questions ==

= Ada pertanyaan seputar modul? =

Silahkan kunjungi https://www.billingotomatis.com/ untuk info dan pertanyaan lebih lanjut

== Screenshots ==

1. Tampilan menu billingotomatis
2. Halaman Konfigurasi

== Changelog ==

= 20160202 =
* Dirilis ke publik

= 20170307 =
* Fixed: CSS konflik dengan Woocomerce terbaru

= 20170328 =
* Support Mata Uang selain IDR lengkap dengan penambahan field konfigurasi Kurs terhadap Rupiah

= 20170711 =
* Penambahan Variable Unik Text pada konfigurasi

= 20171116 =
* Penambahan log informasi woocomerce saat eksekusi mutasi baru

= 20171116 =
* Perbaikan generate angka unik

= 20180123 =
* Penambahan opsi format rupiah dan perubahan keterangan tidak tereksekusi menjadi gagal diproses

= 20180208 =
* Penambahan opsi diskon angka unik (mengurangi total dengan angka unik)

= 20190111 =
* Penggunaan wc_reduce_stock_levels( $order_id );
* Adaptasi untuk support hingga php 7.3
* Penambahan opsi menampilkan logo bank saat pemilihan payment gateway
* Penambahan wordpress editor pada instruksi pembayaran untuk kemudahan mengedit
* Mengabaikan penambahan angka unik pada surcharge jika total order 0

== Upgrade Notice ==

= 20160202 =
Tidak ada notice upgrade

= 20190111 = 
Membutuhkan ioncube encoder minimal versi 10

<?php
function bilo_hook_mutasi_baru_example($args) {
	//Anda bisa lakukan sesuatu dengan fungsi ini...
	//Pada saat data akan masuk kedatabase fungsi ini akan dipanggil
	/* Argument yang tersedia dalam bentuk nilai array:
		bank - Ini nama bank
		transid - Detail transaksi/mutasi
		amount - Jumlah
		type - Tipe Mutasi (CR,DB)
		bankid - Bank ID sesuai yang didefenisikan pada data bank
		dbid - ID baris (kolom `id`) pada database
	*/
	#echo "Test Hook: ".$args['transid']."<br>";

	/*
	Contoh lain: Kirim Email setiap ada data masuk

	mail("email@domainanda.com","Ada transaksi baru dari Bank $bank","Keterangan Transaksi: $transid\n\nJumlah: $amount");

	*/
}
add_action("bilo_hook_mutasi_baru","bilo_hook_mutasi_baru_example");

function bilo_hook_post_process_example($args) {
	//Fungsi ini akan dipanggil setelah semua data mutasi hasil pengecekan disimpan ke database
	/* Argument yang tersedia dalam bentuk nilai array:
		bank - Bank pada data bank (misal: BCA)
		bankid - Bank ID sesuai yang didefenisikan pada data bank
	*/
	global $wpdb;
	$query = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."bilo_mutasi WHERE bankid = '".$args['bankid']."' AND processstatus <> 1");
	if(!$query) {
		echo $args['bankid']." - Hooks: Semua transaksi sepertinya sudah terproses. <br>\n";
		return;
	}
	$i=1;
	$email = "";
	foreach($query as $array) {
		//Lakukan sesuatu
		$transid = str_replace(array("\n","\r"),array(" "," "),$array->transid);
		$email .= "$i.\tJumlah: Rp. $array->amount,\n\tTipe: $array->type,\n\tTrans ID:\n\t$transid\n--------------\n";
		$wpdb->update($wpdb->prefix."bilo_mutasi",array("processstatus"=>1),array("id"=>$array->id));
		$i++;
	}
	$email_notifikasi = get_option('bilo_notif_mail');
	if($email_notifikasi) {
		echo $args['bankid']." - Hooks: Mengirimkan notifikasi email ada mutasi baru yang masuk. <br>\n";
		wp_mail($email_notifikasi,"Ada transaksi Baru via Bank ".$args['bankid'],"Ada log mutasi baru yang berhasil disimpan dari mutasi transfer Bank ".$args['bankid']." (".$args['bank'].").\n\nBerikut detail log mutasinya: \n\n".$email);
	}
}
add_action("bilo_hook_post_process","bilo_hook_post_process_example");

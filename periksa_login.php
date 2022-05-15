<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username' AND user_password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$data = mysqli_fetch_assoc($login);
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['nama'] = $data['user_nama'];
	$_SESSION['username'] = $data['user_username'];
	$_SESSION['level'] = $data['user_level'];

	if($data['user_level'] == "administrator"){
		$_SESSION['status'] = "administrator_logedin";
		header("location:admin/");
	}else if($data['user_level'] == "gudang"){
		$_SESSION['status'] = "gudang_logedin";
		header("location:gudang/");
	}else if($data['user_level'] == "purchasing"){
		$_SESSION['status'] = "purchasing_logedin";
		header("location:purchasing/");
	}else if($data['user_level'] == "finance"){
		$_SESSION['status'] = "finance_logedin";
		header("location:finance/");
	}else if($data['user_level'] == "pimpinan"){
		$_SESSION['status'] = "pimpinan_logedin";
		header("location:pimpinan/");
	}else if($data['user_level'] == "supplier"){
		$_SESSION['status'] = "supplier_logedin";
		header("location:supplier/");
	}else{
		header("location:index.php?alert=gagal");
	}
}else{
	header("location:index.php?alert=gagal");
}

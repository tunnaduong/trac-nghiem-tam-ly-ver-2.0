<!-- Project name: CBH Youth Online (Đoàn trường THPT Chuyên Biên Hoà Online)
	 Project link: https://youth.fattiesoftware.com/
 	 Created by Fatties Software 2020
 	 Team members:
 	 - Duong Tung Anh (CEO/Founder - C4K60 Bien Hoa Gifted High School) | https://fb.me/tunnaduong
	 - Hoang Phat (Co-Founder/Lead Developer - A1K60 Bien Hoa Gifted High School) | https://fb.me/hoangphathandsome
	 All rights reserved 
-->
<?php 
// File serverconnect.php chứa các thông tin quan trọng cần thiết để kết nối với máy chủ
// Bổ sung dòng `require $_SERVER['DOCUMENT_ROOT'] . '/require/serverconnect.php';` ở các file cần kết nối với máy chủ
// Chỉnh sửa thông tin máy chủ một lần duy nhất ở 4 dòng này
////////////////////////////////////////////
$maychu = "localhost";
$tendangnhap = "root";
$matkhau = "";
$tendb = "members";
////////////////////////////////////////////
	$db = mysqli_connect($maychu, $tendangnhap, $matkhau, $tendb);
	$servername = $maychu;
	$username = $tendangnhap;
	$password = $matkhau;
	$dbname = $tendb;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$DATABASE_HOST = $maychu;
	$DATABASE_USER = $tendangnhap;
	$DATABASE_PASS = $matkhau;
	$DATABASE_NAME = $tendb;
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// Mã này giúp cho trang khỏi bị các ký tự Unicode kì lạ
	mysqli_set_charset($conn, 'UTF8');
	mysqli_set_charset($db, 'UTF8');
	mysqli_set_charset($con, 'UTF8');
?>
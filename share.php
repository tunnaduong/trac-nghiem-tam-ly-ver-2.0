<?php
$query = $_GET['query'];
$q_exploded = explode("_", $query);
$name = $q_exploded[0];
$diagnose = $q_exploded[1];
$title = "Trắc nghiệm về chỉ số tâm trạng Ver 2.0 - Tunna Duong";
$desc = $name." ".$diagnose.". Còn bạn thì sao? Test ngay tại đây";
$referral = $_SERVER["HTTP_REFERER"];
$text = "<b>".$name."</b> vừa hoàn thành bài test tâm lý với kết quả ".$diagnose.". <br><span style='color:green'>Test ngay tại link này!</span><br><p style='font-size: 50px'>© 2021 Tunna Duong & Phòng mạch An Sinh</p>.png";
?>
<html>
<head>
<title><?php echo $title ?></title>
<meta name="twitter:card" content="summary" />
<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:description" content="<?php echo $desc ?>" />
<meta property="og:image" content="<?php echo "https://og-image.vercel.app/".rawurlencode($text)."?theme=light&md=1&fontSize=100px&heights=0" ?>" />
<script>
setTimeout(function () {
   window.location.href= './?ref=share_redirect&url_ref=<?php echo $referral ?>';

},1500);
</script>
</head>
<body>
<?php
echo "Hệ thống đang chuyển hướng bạn đến trang đã yêu cầu...<br><a href='./'>Nếu chuyển hướng không hoạt động bạn có thể bấm vào đây</a><br>© ".date("Y")." Tunna Duong & Phòng mạch An Sinh. Bảo lưu mọi quyền";
?>
</body>
</html>
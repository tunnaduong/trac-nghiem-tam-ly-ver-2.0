<!-- Trang web được lập trình bởi Dương Tùng Anh - C4K60 Chuyên Hà Nam -->
<!-- Mọi thông tin chi tiết xin liên hệ https://facebook.com/tunnaduong/ -->
<?php
require 'serverconnect.php';
if (isset($_GET['ref'])) {
$campaign = $_GET['ref'];
$ref_url = $_GET['url_ref'];
} else {
    if (!isset($_SERVER['HTTP_REFERER'])) {
        $campaign = "natural_visit";
        $ref_url =  "new_tab";
    } else {
        $campaign = "natural_click";
        $ref_url =  $_SERVER["HTTP_REFERER"];
    }
}
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
$user_ip = getUserIP();
$details = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
$location = "{$details->city}, {$details->country}";
$sql = "INSERT INTO referral (campaign, ref_url, website, ip_address, location) VALUES ('$campaign', '$ref_url', 'tunnaduong.com/tramcam', '$user_ip', '$location')";
$conn->query($sql);
$sql = "SELECT LAST_INSERT_ID() AS id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $referral_id = $row["id"];
    }
}
$conn->close();
?>
<head>
    <title>Trắc nghiệm về chỉ số tâm trạng - Version 2.0</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5468db3c8c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <style>
        .lamlai {
            background-color: #e8e8e8;
        }
        .lamlai:hover {
            background-color: #cecece;
        }
        .share {
            color: white;
            background-color: #1877f2;
        }
        .share:hover {
            background-color: #0167ec;
            color: white;
        }
        .share:active {
            background-color: #0453bb !important;
            color: white !important;
        }
    </style>
    <style>
        body {
            background: rgb(53, 95, 103);
            background: linear-gradient(133deg, rgba(53, 95, 103, 1) 0%, rgba(226, 107, 38, 1) 53%);
            /* background: rgb(0,212,255);
      background: linear-gradient(133deg, rgba(0,212,255,1) 0%, rgba(191,141,207,1) 90%); */
        }
        
        body {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        .txts {
            text-align: center;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            color: #000;
            background-clip: text;
            text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .mainDiv {
            background: #fff;
            border-radius: 10px;
            width: 420px;
            margin: 0px auto;
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            -webkit-box-shadow: 0 5px 13px 13px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        }
        
        .mainDivketqua {
            background: #fff;
            border-radius: 10px;
            width: 420px;
            margin: 0px auto;
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            -webkit-box-shadow: 0 5px 13px 13px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-box {
            max-height: 120px;
            position: relative;
            overflow: hidden;
        }
        
        .main {
            color: white;
        }
        
        .sidebar-box .read-more {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            margin: 0;
            padding: 30px 0;
            /* "transparent" only works here because == rgba(0,0,0,0) */
            background-image: linear-gradient(to bottom, transparent, white);
        }
        
        .sk-folding-cube {
            margin: 20px auto;
            width: 40px;
            height: 40px;
            position: relative;
            -webkit-transform: rotateZ(45deg);
            transform: rotateZ(45deg);
        }
        
        .sk-folding-cube .sk-cube {
            float: left;
            width: 50%;
            height: 50%;
            position: relative;
            -webkit-transform: scale(1.1);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
        }
        
        .sk-folding-cube .sk-cube:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #333;
            -webkit-animation: sk-foldCubeAngle 2.4s infinite linear both;
            animation: sk-foldCubeAngle 2.4s infinite linear both;
            -webkit-transform-origin: 100% 100%;
            -ms-transform-origin: 100% 100%;
            transform-origin: 100% 100%;
        }
        
        .sk-folding-cube .sk-cube2 {
            -webkit-transform: scale(1.1) rotateZ(90deg);
            transform: scale(1.1) rotateZ(90deg);
        }
        
        .sk-folding-cube .sk-cube3 {
            -webkit-transform: scale(1.1) rotateZ(180deg);
            transform: scale(1.1) rotateZ(180deg);
        }
        
        .sk-folding-cube .sk-cube4 {
            -webkit-transform: scale(1.1) rotateZ(270deg);
            transform: scale(1.1) rotateZ(270deg);
        }
        
        .sk-folding-cube .sk-cube2:before {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;
        }
        
        .sk-folding-cube .sk-cube3:before {
            -webkit-animation-delay: 0.6s;
            animation-delay: 0.6s;
        }
        
        .sk-folding-cube .sk-cube4:before {
            -webkit-animation-delay: 0.9s;
            animation-delay: 0.9s;
        }
        
        @-webkit-keyframes sk-foldCubeAngle {
            0%,
            10% {
                -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                -webkit-transform: perspective(140px) rotateX(0deg);
                transform: perspective(140px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                -webkit-transform: perspective(140px) rotateY(180deg);
                transform: perspective(140px) rotateY(180deg);
                opacity: 0;
            }
        }
        
        @keyframes sk-foldCubeAngle {
            0%,
            10% {
                -webkit-transform: perspective(140px) rotateX(-180deg);
                transform: perspective(140px) rotateX(-180deg);
                opacity: 0;
            }
            25%,
            75% {
                -webkit-transform: perspective(140px) rotateX(0deg);
                transform: perspective(140px) rotateX(0deg);
                opacity: 1;
            }
            90%,
            100% {
                -webkit-transform: perspective(140px) rotateY(180deg);
                transform: perspective(140px) rotateY(180deg);
                opacity: 0;
            }
        }
        
        .sk-folding-cube {
            width: 80px;
            height: 80px;
        }
        
        @media (max-width:375px) {
            .mainDiv {
                margin-top: 0px;
            }
            .mainDivketqua {
                margin-top: -35;
            }
            .mainDivresult {
                margin-left: -21;
                margin-top: -15;
            }
            .mainDivresult2 {
                margin-top: -15;
            }
        }
    </style>

</head>

<body>

    <a href="." style="display: none;color: white;" id="errorhandle">Có vẻ như chúng ta đang gặp phải một lỗi nghiêm trọng khiến cho trắc nghiệm không thể tải. Ấn vào đây để tải lại trang.</a>
    <div class="mainDiv" style="zoom: 0.893;" id="mainDiv">
        <div class="loadd" style="display: none;margin-top: 100px;margin-bottom: 100px;" id="concu">

            <div class="sk-folding-cube">
                <div class="sk-cube1 sk-cube"></div>
                <div class="sk-cube2 sk-cube"></div>
                <div class="sk-cube4 sk-cube"></div>
                <div class="sk-cube3 sk-cube"></div>
            </div>
            <br>
            <center>
                <h4>Bám chắc nhé! Đang tải trắc nghiệm...</h4>
                <h6><i class="fas fa-code"></i> with <i class="fas fa-heart"></i> by Dương Tùng Anh</h6>
            </center>
        </div>
        <div class="ready" style="display: none;" id="ready">
            <center>
                <h4 style="margin-top: 180px;">SẴN SÀNG!</h4>
            </center>
        </div>

        <div class="insidemainDiv" id="insidemainDiv" style="display: block;">
            <img src="depress_heal.jpg" style="width: 400px;border-radius: 8px;">
            <h3 style="margin-top: 15px;font-size: 25px;"><b>Khảo sát phát hiện sớm dấu hiệu trầm cảm</b></h3>
            <div class="side-box">
                <p>
                    Hiện nay, nhiều bệnh tâm thần đã được chữa khỏi nếu được phát hiện sớm và điều trị hợp lý kịp thời. Chăm sóc sức khỏe tâm thần là nâng tầm chất lượng sống và cảm xúc là một phần quan trọng không thể thiếu của sức khỏe tâm thần. <br><b>Chú ý: Hãy tải lại trang
                    nếu trắc nghiệm không thể tải và bạn nhìn thấy nền xanh đỏ.</b></p>
            </div>

            <hr>
            <h5><b>Thông tin về trắc nghiệm</b></h5>
            <p style="display: inline;"><i class="fas fa-user-edit"></i> Người tạo: </p>
            <p id="complete" style="display: inline;">Trung tâm CSSK tâm thần cộng đồng</p>
            <br>
            <p style="display: inline;"><i class="fas fa-clock"></i> Thời gian dự tính: </p>
            <p id="complete" style="display: inline;">3 phút</p>
            <br>
            <p style="display: inline;"><i class="fas fa-user-check"></i> Lượt hoàn thành: </p>
            <p id="complete" style="display: inline;">23</p>
            <br>

            <a href="#" class="txts" style="float: right;font-size: 20px;color: #e26b26;" onclick="mainFade()"><b>Làm trắc nghiệm ></b></a>
            <a href="#" class="txts" style="float: left;font-size: 20px;margin-top: 20px;color: orange;opacity: 0.3;" onclick="skip()"><b>Skip >.< (for developing purpose only)</b></a>
            <br>
        </div>
    </div>
    <script>
        function mainFade() {
            const element = document.querySelector('.insidemainDiv')
            element.classList.add('animated', 'fadeOut', 'faster')
            element.addEventListener('animationend', function() {
                document.getElementById("errorhandle").style.display = "block";
                loadd()
            })
            setTimeout(hideDiv, 550)
            return true;

            function hideDiv() {
                document.getElementById("insidemainDiv").style.display = 'none';
            }
        }

        // For developing purpose, the skipable content should start here

        function skip() {
            document.getElementById("mainDiv").style.display = 'none';
            hienCauhoi1();
        }

        function hienCauhoi1() {
            document.getElementById("thongbaoend").style.display = 'none';
            document.getElementById("cauhoi1").style.display = 'block';
            const element = document.querySelector('.cauhoi')
            element.classList.add('animated', 'fadeInDown')
        }

        function fadeCauhoi1() {
            const element = document.querySelector('.cauhoi')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                hienCauhoi2()
            })
        }

        function hienCauhoi2() {
            document.getElementById("cauhoi1").style.display = 'none';
            document.getElementById("cauhoi2").style.display = 'block';
            const element = document.querySelector('.cauhoi2')
            element.classList.add('animated', 'fadeInDown')
        }

        function fadeCauhoi2() {
            const element = document.querySelector('.cauhoi2')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                hienThongbaoAfter()
            })
        }

        function hienThongbaoAfter() {
            document.getElementById("cauhoi2").style.display = 'none';
            document.getElementById("thongbaoafter").style.display = 'block';
            const element = document.querySelector('.thongbaoafter')
            element.classList.add('animated', 'fadeInDown')
        }
        // And then end here

        // Normally it should be started here
        function loadd() {
            document.getElementById("errorhandle").style.display = "none";
            document.getElementById("concu").style.display = 'block';
            const element = document.querySelector('.loadd')
            element.classList.add('animated', 'fadeInDown')
            element.addEventListener('animationend', function() {
                setTimeout(loadBounce, 2050)
            })
        }


        function loadBounce() {
            const element = document.querySelector('.loadd')
            element.classList.remove('fadeInDown')
            element.classList.add('bounceOut')
            element.addEventListener('animationend', function() {
                ready()
            })
        }

        function ready() {
            document.getElementById("mainDiv").style.width = '420px';
            document.getElementById("mainDiv").style.height = '427px';
            document.getElementById("concu").style.display = 'none';
            document.getElementById("ready").style.display = 'block';
            const element = document.querySelector('.ready')
            element.classList.add('animated', 'bounceIn')
            element.addEventListener('animationend', function() {
                endLoad()
            })
        }

        function endLoad() {
            document.getElementById("mainDiv").style.display = 'block';
            document.getElementById("mainDiv").style.width = '420px';
            document.getElementById("mainDiv").style.height = '427px';
            const element = document.querySelector('.mainDiv')
            setTimeout(finalEnd, 1550)

            function finalEnd() {
                element.classList.add('animated', 'fadeOut', 'faster')
                element.addEventListener('animationend', function() {
                    warmup()
                })
            }
        }

        function warmup() {
            document.getElementById("mainDiv").style.display = 'none';
            document.getElementById("warmup").style.display = 'block';
            document.getElementById("truoc").style.display = 'block';
            const element = document.querySelector('.warmup')
            element.classList.add('animated', 'fadeInDown')
            element.addEventListener('animationend', function() {
                warmup2()
            })

            function warmup2() {
                document.getElementById("sau").style.display = 'block';
                const element = document.querySelector('.warmup2')
                element.classList.add('animated', 'fadeInDown')
                element.addEventListener('animationend', function() {
                    setTimeout(fadeWarm, 2050)
                })
            }

            function fadeWarm() {
                const element = document.querySelector('.warmup3')
                element.classList.add('animated', 'fadeOutDown')
                element.addEventListener('animationend', function() {
                    askName()
                })
            }
        }

        function askName() {
            document.getElementById("warmup").style.display = 'none';
            document.getElementById("askName").style.display = 'block';
            document.getElementById("tenban").style.display = 'block';
            const element = document.querySelector('.name')
            element.classList.add('animated', 'fadeInDown')
        }




        function loadProgress() {
            const element = document.querySelector('.pgb2')
            element.classList.add('progress-bar-striped', 'progress-bar-animated')
        }

        function anProgress() {
            const element = document.querySelector('.pgb')
            element.classList.add('animated', 'fadeOutUp')
            element.addEventListener('animationend', function() {
                document.getElementById("pgb-main").style.display = 'none';
                hienThongbao()
            })
        }

        function hienThongbao() {
            document.getElementById("thongbao-done").style.display = 'block';
            document.getElementById("thongbao-truoc").style.display = 'block';
            const element = document.querySelector('.done')
            element.classList.add('animated', 'fadeInDown')
            element.addEventListener('animationend', function() {
                hienThongbao2()
            })
        }

        function hienThongbao2() {
            document.getElementById("thongbao-sau").style.display = 'block';
            const element = document.querySelector('.done2')
            element.classList.add('animated', 'fadeInDown')
            element.addEventListener('animationend', function() {
                setTimeout(fadeThongbao, 2050)
            })
        }

        function fadeThongbao() {
            const element = document.querySelector('.done3')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                thongbaoend()
            })
        }

        function thongbaoend() {
            document.getElementById("thongbao-done").style.display = 'none';
            document.getElementById("thongbaoend").style.display = 'block';
            const element = document.querySelector('.thongbaoend')
            element.classList.add('animated', 'fadeInDown')
            element.addEventListener('animationend', function() {
                setTimeout(fadeThongbao2, 4050)
            })
        }

        function fadeThongbao2() {
            const element = document.querySelector('.hide1')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                hienCauhoi1()
            })
        }

        function hienCauhoi1() {
            document.getElementById("cauhoi1").style.display = 'block';
            document.getElementById("thongbaoend").style.display = 'none';
            const element = document.querySelector('.cauhoi')
            element.classList.add('animated', 'fadeInDown')
            element.addEventListener('animationend', function() {
                setTimeout(f, 2050)
            })
        }
    </script>
    <style>
        .but:link,
        .but:visited {
            background-color: #ffffff;
            color: black;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 50px;
        }
        
        .but:hover,
        .but:active {
            background-color: white;
        }
        
        .segmented-control {
            display: flex;
            flex-wrap: wrap;
            margin: 0;
            padding: 0;
            border: 1px solid #ffffff;
            border-radius: 4px;
        }
        
        .segmented-control input[type='radio'] {
            position: absolute;
            overflow: hidden;
            height: 1px;
            width: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
            clip: rect(0 0 0 0);
        }
        
        .segmented-control label {
            flex: 1 0 auto;
            text-align: center;
            margin: 0;
            padding: .5rem 1rem;
            border-right: 1px solid #ffffff;
            cursor: pointer;
            font-family: Helvetica, Arial, Sans serif;
            font-weight: 600;
            color: #ffffff;
        }
        
        .segmented-control label:last-child {
            border: none;
        }
        
        .segmented-control input[type='radio']:checked+label,
        .segmented-control input[type='radio']:focus+label {
            background-color: #ffffff;
            color: black;
        }
        
        .buttoninline {
            flex-flow: row wrap;
            align-items: center;
        }
        
        .activee {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activee:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activeee {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activeee:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activeeee {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activeeee:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activeeeee {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .activeeeee:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active5 {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active5:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active6 {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active6:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active7 {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active7:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active8 {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active8:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active9 {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active9:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active10 {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .active10:hover {
            background-color: #a9ffa9;
            border: 2px solid black;
        }
        
        .error {
            position: relative;
            animation: shake .15s linear;
            animation-iteration-count: 3;
            border-style: solid;
            border-width: 3px;
            border-color: red;
        }
        
        @keyframes shake {
            0% {
                margin-left: 0rem;
            }
            25% {
                margin-left: 0.5rem;
            }
            75% {
                margin-left: -0.5rem;
            }
            100% {
                margin-left: 0rem;
            }
        }
        
        .error1 {
            border-style: solid;
            border-width: 1px;
            border-color: red;
        }
    </style>
    <div class="warmup3" id="warmup" style="display: none;">
        <center>
            <h3 class="main warmup" id="truoc" style="display: none;margin-top: 50px;">Trước khi bắt đầu,</h3>
            <h3 class="main warmup2" id="sau" style="display: none;">chúng tôi muốn biết một vài thông tin cá nhân của bạn.</h3>
        </center>
    </div>

    <div id="askName" style="display: none;">
        <div class="progress pgb" id="pgb-main">
            <div class="progress-bar bg-success pgb2" style="width:10%" id="progressbar">10%</div>
        </div>
        <center>


            <div id="tenban" style="display: none;width: 380px;">
                <h3 class="main name" style="margin-top: 50px;">Uhmm....Bạn tên là gì nhỉ?</h3>
                <input class="form-control form-control-lg name2" type="text" id="username" placeholder="VD: Dương Tùng Anh">
                <br>
                <script>
                    function sex() {
                        var username = document.getElementById('username');
                        if (username.value.trim() == '') {

                            // Add a class that defines an animation
                            username.classList.add('error');

                            // remove the class after the animation completes
                            setTimeout(function() {
                                username.classList.remove('error');
                            }, 300);

                            e.preventDefault();
                        } else {
                            username.style.backgroundColor = null;
                            const element = document.querySelector('.name')
                            element.classList.remove('fadeInDown')
                            element.classList.add('animated', 'fadeOutDown')
                            element.addEventListener('animationend', function() {
                                document.getElementById("tenban").style.display = 'none';
                                askSex()
                            })

                            function askSex() {
                                document.getElementById("gioitinh").style.display = 'block';
                                document.getElementById("progressbar").innerHTML = "40%";
                                document.getElementById("progressbar").style.width = '40%';
                                const element = document.querySelector('.sex')
                                element.classList.add('animated', 'fadeInDown')
                            }
                        }

                    }
                </script>
                <a class="but" href="javascript:sex()">Tiếp tục <i class="fas fa-chevron-right"></i></a>
            </div>
            <div id="gioitinh" style="display: none;width: 380px;">
                <h3 class="main sex" style="margin-top: 50px;">OK, thế còn giới tính của bạn thì sao?</h3>
                <form action="#">
                    <div id="sda" class="segmented-control">
                        <input onclick="cl = 1;" type="radio" name="sex" id="male" value="male" />
                        <label for="male">Nam</label>
                        <input onclick="cl = 1;" type="radio" name="sex" id="female" value="female" />
                        <label for="female">Nữ</label>
                        <input onclick="cl = 1;" type="radio" name="sex" id="other" value="other" />
                        <label for="other">Khác</label>
                        <input onclick="cl = 1;" type="radio" name="sex" id="rathernotsay" value="rathernotsay" />
                        <label for="rathernotsay">Không muốn nói</label>
                    </div>
                    <script>
                        var cl = 0;

                        function age() {
                            if (cl == 1) {
                                const element = document.querySelector('.sex')
                                element.classList.remove('animated', 'fadeInDown')
                                element.classList.add('animated', 'fadeOutDown')
                                element.addEventListener('animationend', function() {
                                    document.getElementById("gioitinh").style.display = 'none';
                                    askAge()
                                })

                                function askAge() {
                                    document.getElementById("tuoi").style.display = 'block';
                                    document.getElementById("progressbar").innerHTML = "70%";
                                    document.getElementById("progressbar").style.width = '70%';
                                    const element = document.querySelector('.age')
                                    element.classList.add('animated', 'fadeInDown')
                                }

                            } else {
                                // Add a class that defines an animation
                                document.getElementById('sda').classList.add('error1');

                                // remove the class after the animation completes
                                setTimeout(function() {
                                    username.classList.remove('error');
                                }, 500);


                                e.preventDefault();
                            }

                        }
                    </script>
                </form>
                <br>
                <a class="but" href="javascript:age()">Tiếp tục <i class="fas fa-chevron-right"></i></a>
            </div>
            <div id="tuoi" style="display: none;width: 380px;">
                <h3 class="main age" style="margin-top: 50px;">Được rồi, câu hỏi cuối cùng này... Bạn hiện nay bao nhiêu tuổi?</h3>
                <input class="form-control form-control-lg name2" type="text" placeholder="VD: 17" id="intLimitTextBox">
                <br>
                <script type="text/javascript">
                    function thongbao() {
                        var username2 = document.getElementById('intLimitTextBox');
                        if (username2.value.trim() == '') {

                            // Add a class that defines an animation
                            username2.classList.add('error');

                            // remove the class after the animation completes
                            setTimeout(function() {
                                username2.classList.remove('error');
                            }, 300);

                            e.preventDefault();
                        } else {
                            const element = document.querySelector('.age')
                            element.classList.remove('animated', 'fadeInDown')
                            element.classList.add('animated', 'fadeOutDown')
                            element.addEventListener('animationend', function() {
                                document.getElementById("tuoi").style.display = 'none';
                                document.getElementById("progressbar").innerHTML = "100%";
                                document.getElementById("progressbar").style.width = '100%';
                                loadProgress();
                                setTimeout(anProgress, 2050)
                            })
                        }
                    }
                </script>
                <a class="but" href="javascript:thongbao()">Tiếp tục <i class="fas fa-chevron-right"></i></a>
            </div>
        </center>
    </div>
    <div class="done3" id="thongbao-done" style="display: none;">
        <center>
            <h3 class="main done" id="thongbao-truoc" style="display: none;margin-top: 50px;">Thật tốt khi được hiểu thêm về bạn,</h3>
            <h3 class="main done2" id="thongbao-sau" style="display: none;">giờ chúng ta hãy cùng bắt đầu trắc nghiệm nào...</h3>
        </center>
    </div>
    <div class="hide1" id="thongbaoend" style="display: none;">
        <center>
            <h3 class="thongbaoend main hide1" style="margin-top: 50px;font-size: 25px;">Trong 2 tuần qua, bạn có thường gặp phải các vấn đề sau đây?</h3>
        </center>
    </div>
    <center>
        <div class="cauhoi" id="cauhoi1" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 1</p>
            <p class="main" style="font-size: 25px;">Giảm quan tâm hoặc hứng thú trong mọi hoạt động</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light buttonn activee" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ1A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light buttonn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ1A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light buttonn" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ1A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light buttonn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ1A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <script>
            </script>
            <a class="but" href="javascript:fadeCauhoi1()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>
    </center>

    <center>
        <div class="cauhoi2" id="cauhoi2" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 2</p>
            <p class="main" style="font-size: 25px;">Cảm thấy trì trệ, chán nản, bi quan hoặc không còn hi vọng</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light buttonnn activeee" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ2A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light buttonnn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ2A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light buttonnn" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ2A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light buttonnn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ2A4()">Hầu như mỗi ngày</button>
                </div>
            </div>

            <a class="but" href="javascript:fadeCauhoi2();window.tongdiem1 = x1 + x2;if (window.tongdiem1 < 3) {
			funcsion1()
		} else if (window.tongdiem1 >= 3) {
			funcsion2()
		}document.getElementById('tongdiemcuaban').innerHTML = window.tongdiem1;
        
        " style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>
    </center>

    <center id="center1">
        <div class="thongbaoafter" id="thongbaoafter" style="display: none;width: 90%;max-width: 580px;">
            <script>
                // Add active class to the current button (highlight it)
                var header = document;
                var btns = header.getElementsByClassName("buttonn");
                for (var i = 0; i < btns.length; i++) {
                    btns[i].addEventListener("click", function() {
                        var current = document.getElementsByClassName("activee");
                        current[0].className = current[0].className.replace(" activee", "");
                        this.className += " activee";
                    });
                }

                var x1 = 0;

                function changeScoreQ1A1() {
                    x1 = 0;
                    document.getElementById("diemcau1").innerHTML = "Câu 1: " + x1 + " điểm";
                }

                function changeScoreQ1A2() {
                    x1 = 1;
                    document.getElementById("diemcau1").innerHTML = "Câu 1: " + x1 + " điểm";
                }

                function changeScoreQ1A3() {
                    x1 = 2;
                    document.getElementById("diemcau1").innerHTML = "Câu 1: " + x1 + " điểm";
                }

                function changeScoreQ1A4() {
                    x1 = 3;
                    document.getElementById("diemcau1").innerHTML = "Câu 1: " + x1 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header2 = document;
                var btns2 = header2.getElementsByClassName("buttonnn");
                for (var i2 = 0; i2 < btns2.length; i2++) {
                    btns2[i2].addEventListener("click", function() {
                        var current2 = document.getElementsByClassName("activeee");
                        current2[0].className = current2[0].className.replace(" activeee", "");
                        this.className += " activeee";
                    });
                }

                var x2 = 0;

                function changeScoreQ2A1() {
                    x2 = 0;
                    document.getElementById("diemcau2").innerHTML = "Câu 2: " + x2 + " điểm";
                }

                function changeScoreQ2A2() {
                    x2 = 1;
                    document.getElementById("diemcau2").innerHTML = "Câu 2: " + x2 + " điểm";
                }

                function changeScoreQ2A3() {
                    x2 = 2;
                    document.getElementById("diemcau2").innerHTML = "Câu 2: " + x2 + " điểm";
                }

                function changeScoreQ2A4() {
                    x2 = 3;
                    document.getElementById("diemcau2").innerHTML = "Câu 2: " + x2 + " điểm";
                }

                function funcsion1() {
                    var thongb = 'Cảm xúc của bạn tốt';
                    document.getElementById("tunnaa").innerHTML = thongb;
                    document.getElementById("loikhuyen").innerHTML = thongb + ". Bạn không có biểu hiện của bệnh, khả năng thích nghi của cơ thể và tinh thần tốt.";
                }

                function funcsion2() {
                    var thongb = "Xin bạn vui lòng trả lời tiếp các câu hỏi trong bảng phỏng vấn PHQ-9";
                    document.getElementById("tunnaa").innerHTML = thongb;
                    document.getElementById("seewhy").innerHTML = "";
                    setTimeout(myFunction, 4400)

                    function myFunction() {
                        const element = document.querySelector('.thongbaoafter')
                        element.classList.add('animated', 'fadeOutDown')
                        element.addEventListener('animationend', function() {
                            hienCauhoi3()
                        })
                    }
                }

                function hienCauhoi3() {
                    document.getElementById("thongbaoafter").style.display = 'none';
                    document.getElementById("cauhoi3").style.display = 'block';
                    const element = document.querySelector('.cauhoi3')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi3() {
                    const element = document.querySelector('.cauhoi3')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi4()
                    })
                }

                function hienCauhoi4() {
                    document.getElementById("cauhoi3").style.display = 'none';
                    document.getElementById("cauhoi4").style.display = 'block';
                    const element = document.querySelector('.cauhoi4')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi4() {
                    const element = document.querySelector('.cauhoi4')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi5()
                    })
                }

                function hienCauhoi5() {
                    document.getElementById("cauhoi4").style.display = 'none';
                    document.getElementById("cauhoi5").style.display = 'block';
                    const element = document.querySelector('.cauhoi5')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi5() {
                    const element = document.querySelector('.cauhoi5')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi6()
                    })
                }

                function hienCauhoi6() {
                    document.getElementById("cauhoi5").style.display = 'none';
                    document.getElementById("cauhoi6").style.display = 'block';
                    const element = document.querySelector('.cauhoi6')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi6() {
                    const element = document.querySelector('.cauhoi6')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi7()
                    })
                }

                function hienCauhoi7() {
                    document.getElementById("cauhoi6").style.display = 'none';
                    document.getElementById("cauhoi7").style.display = 'block';
                    const element = document.querySelector('.cauhoi7')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi7() {
                    const element = document.querySelector('.cauhoi7')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi8()
                    })
                }

                function hienCauhoi8() {
                    document.getElementById("cauhoi7").style.display = 'none';
                    document.getElementById("cauhoi8").style.display = 'block';
                    const element = document.querySelector('.cauhoi8')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi8() {
                    const element = document.querySelector('.cauhoi8')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi9()
                    })
                }

                function hienCauhoi9() {
                    document.getElementById("cauhoi8").style.display = 'none';
                    document.getElementById("cauhoi9").style.display = 'block';
                    const element = document.querySelector('.cauhoi9')
                    element.classList.add('animated', 'fadeInDown')
                }

                function fadeCauhoi9() {
                    const element = document.querySelector('.cauhoi9')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienCauhoi10()
                    })
                }

                function hienCauhoi10() {
                    document.getElementById("cauhoi9").style.display = 'none';
                    document.getElementById("cauhoi10").style.display = 'block';
                    const element = document.querySelector('.cauhoi10');
                    element.classList.add('animated', 'fadeInDown');
                }

                var testTaken = "";
            </script>
            <style>
                .checkmark__circle {
                    stroke-dasharray: 166;
                    stroke-dashoffset: 166;
                    stroke-width: 2;
                    stroke-miterlimit: 10;
                    stroke: green;
                    fill: black;
                    fill-opacity: 0;
                    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
                }
                
                .checkmark {
                    width: 56px;
                    height: 56px;
                    border-radius: 50%;
                    display: block;
                    stroke-width: 2;
                    stroke: green;
                    stroke-miterlimit: 10;
                    margin: 10% auto;
                    box-shadow: inset 0px 0px 0px #7ac142;
                    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
                }
                
                .checkmark__check {
                    transform-origin: 50% 50%;
                    stroke-dasharray: 48;
                    stroke-dashoffset: 48;
                    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
                }
                
                @keyframes stroke {
                    100% {
                        stroke-dashoffset: 0;
                    }
                }
                
                @keyframes scale {
                    0%,
                    100% {
                        transform: none;
                    }
                    50% {
                        transform: scale3d(1.1, 1.1, 1);
                    }
                }
                
                @keyframes fill {
                    100% {
                        box-shadow: inset 0px 0px 0px 30px #fff;
                    }
                }
            </style>

            <div class="mainDiv mainDivresult" style="zoom: 0.893;" id="mainDiv2">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" style="margin-top: 50px;margin-bottom: 0px" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
                <h3 id="tunnaa" style="margin-top: 20px;">Tunna</h3>
                <br>
                <a href="javascript:fadeKetqua1();mucdocuaban();" style="color: #7b7b7b;" id="seewhy">Xem lý do tại sao và thông tin chi tiết</a>
            </div>
        </div>
        <div id="cauhoi3" class="cauhoi3" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 3</p>
            <p class="main" style="font-size: 25px;">Khó ngủ, mất ngủ hoặc ngủ rất nhiều</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light buttonnnn activeeee" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ3A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light buttonnnn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ3A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light buttonnnn" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ3A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light buttonnnn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ3A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi3()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>
        <div id="cauhoi4" class="cauhoi4" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 4</p>
            <p class="main" style="font-size: 25px;">Cảm thấy mệt mỏi hoặc kiệt sức</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light buttonnnnn activeeeee" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ4A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light buttonnnnn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ4A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light buttonnnnn" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ4A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light buttonnnnn" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ4A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi4()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>
        <div id="cauhoi5" class="cauhoi5" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 5</p>
            <p class="main" style="font-size: 25px;">Chán ăn hoặc ăn quá nhiều</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light button5 active5" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ5A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light button5" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ5A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light button5" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ5A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light button5" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ5A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi5()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>
        <div id="cauhoi6" class="cauhoi6" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 6</p>
            <p class="main" style="font-size: 25px;">Cảm thấy bản thân thất bại, vô dụng hoặc cảm thấy đã làm cho người thân và gia đình thất vọng</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light button6 active6" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ6A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light button6" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ6A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light button6" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ6A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light button6" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ6A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi6()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>

        <div id="cauhoi7" class="cauhoi7" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 7</p>
            <p class="main" style="font-size: 25px;">Khó tập trung trong các hoạt động, chẳng hạn như đọc báo hay xem TV</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light button7 active7" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ7A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light button7" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ7A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light button7" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ7A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light button7" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ7A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi7()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>

        <div id="cauhoi8" class="cauhoi8" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 8</p>
            <p class="main" style="font-size: 25px;">Di chuyển hoặc nói chuyện quá chậm chạp đến mức mọi người có thể nhận ra. Hoặc cảm thấy bứt rứt, hoặc không yên đến mức cử động nhiều hơn bình thường</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light button8 active8" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ8A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light button8" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ8A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light button8" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ8A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light button8" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ8A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi8()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>

        <div id="cauhoi9" class="cauhoi9" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 9</p>
            <p class="main" style="font-size: 25px;">Có ý nghĩ muốn chết đi cho xong hoặc có ý muốn tự làm tổn thương bản thân</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light button9 active9" style="width: 150px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ9A1()">Không lúc nào</button>
                    <button type="button" class="btn btn-light button9" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ9A2()">Vài ngày</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light button9" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;font-size: 12px" onclick="changeScoreQ9A3()">Hơn một nửa số ngày</button>
                    <button type="button" class="btn btn-light button9" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ9A4()">Hầu như mỗi ngày</button>
                </div>
            </div>
            <a class="but" href="javascript:fadeCauhoi9()" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>

        <div id="cauhoi10" class="cauhoi10" style="display: none;width: 90%;max-width: 580px;">

            <p class="main" style="margin-top: 50px;margin-bottom: 0px;">CÂU HỎI 10</p>
            <p class="main" style="font-size: 25px;">Trong bất kỳ vấn đề trên nếu có gặp phải, hãy cho biết nó đã gây khó khăn như thế nào đối với công việc làm, việc nhà, hoặc với những người xung quanh?</p>
            <hr style="background-color: white;opacity: 0.5;">

            <div id="buttons">
                <div class="buttoninline">
                    <button type="button" class="btn btn-light button10 active10" style="width: 150px;margin-right: 20px;border-radius: 50px;font-size: 14px;" onclick="changeScoreQ10A1()">Không có khó khăn</button>
                    <button type="button" class="btn btn-light button10" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ10A2()">Đôi khi khó khăn</button>
                </div>
                <div class="buttoninline" style="margin-top: 20px;">
                    <button type="button" class="btn btn-light button10" style="width: 150px;height: 38px;margin-right: 20px;border-radius: 50px;" onclick="changeScoreQ10A3()">Rất khó khăn</button>
                    <button type="button" class="btn btn-light button10" style="width: 150px;border-radius: 50px;" onclick="changeScoreQ10A4()">Cực kỳ khó khăn</button>
                </div>
            </div>
            <script type="text/javascript">
                // Add active class to the current button (highlight it)
                var header10 = document;
                var btns10 = header10.getElementsByClassName("button10");
                for (var i10 = 0; i10 < btns10.length; i10++) {
                    btns10[i10].addEventListener("click", function() {
                        var current10 = document.getElementsByClassName("active10");
                        current10[0].className = current10[0].className.replace(" active10", "");
                        this.className += " active10";
                    });
                }
                // Add active class to the current button (highlight it)
                var header3 = document;
                var btns3 = header3.getElementsByClassName("buttonnnn");
                for (var i3 = 0; i3 < btns3.length; i3++) {
                    btns3[i3].addEventListener("click", function() {
                        var current3 = document.getElementsByClassName("activeeee");
                        current3[0].className = current3[0].className.replace(" activeeee", "");
                        this.className += " activeeee";
                    });
                }

                var x3 = 0;

                function changeScoreQ3A1() {
                    x3 = 0;
                    document.getElementById("diemcau3").innerHTML = "Câu 3: " + x3 + " điểm";
                }

                function changeScoreQ3A2() {
                    x3 = 1;
                    document.getElementById("diemcau3").innerHTML = "Câu 3: " + x3 + " điểm";
                }

                function changeScoreQ3A3() {
                    x3 = 2;
                    document.getElementById("diemcau3").innerHTML = "Câu 3: " + x3 + " điểm";
                }

                function changeScoreQ3A4() {
                    x3 = 3;
                    document.getElementById("diemcau3").innerHTML = "Câu 3: " + x3 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header4 = document;
                var btns4 = header4.getElementsByClassName("buttonnnnn");
                for (var i4 = 0; i4 < btns4.length; i4++) {
                    btns4[i4].addEventListener("click", function() {
                        var current4 = document.getElementsByClassName("activeeeee");
                        current4[0].className = current4[0].className.replace(" activeeeee", "");
                        this.className += " activeeeee";
                    });
                }

                var x4 = 0;

                function changeScoreQ4A1() {
                    x4 = 0;
                    document.getElementById("diemcau4").innerHTML = "Câu 4: " + x4 + " điểm";
                }

                function changeScoreQ4A2() {
                    x4 = 1;
                    document.getElementById("diemcau4").innerHTML = "Câu 4: " + x4 + " điểm";
                }

                function changeScoreQ4A3() {
                    x4 = 2;
                    document.getElementById("diemcau4").innerHTML = "Câu 4: " + x4 + " điểm";
                }

                function changeScoreQ4A4() {
                    x4 = 3;
                    document.getElementById("diemcau4").innerHTML = "Câu 4: " + x4 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header5 = document;
                var btns5 = header5.getElementsByClassName("button5");
                for (var i5 = 0; i5 < btns5.length; i5++) {
                    btns5[i5].addEventListener("click", function() {
                        var current5 = document.getElementsByClassName("active5");
                        current5[0].className = current5[0].className.replace(" active5", "");
                        this.className += " active5";
                    });
                }

                var x5 = 0;

                function changeScoreQ5A1() {
                    x5 = 0;
                    document.getElementById("diemcau5").innerHTML = "Câu 5: " + x5 + " điểm";
                }

                function changeScoreQ5A2() {
                    x5 = 1;
                    document.getElementById("diemcau5").innerHTML = "Câu 5: " + x5 + " điểm";
                }

                function changeScoreQ5A3() {
                    x5 = 2;
                    document.getElementById("diemcau5").innerHTML = "Câu 5: " + x5 + " điểm";
                }

                function changeScoreQ5A4() {
                    x5 = 3;
                    document.getElementById("diemcau5").innerHTML = "Câu 5: " + x5 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header6 = document;
                var btns6 = header6.getElementsByClassName("button6");
                for (var i6 = 0; i6 < btns6.length; i6++) {
                    btns6[i6].addEventListener("click", function() {
                        var current6 = document.getElementsByClassName("active6");
                        current6[0].className = current6[0].className.replace(" active6", "");
                        this.className += " active6";
                    });
                }

                var x6 = 0;

                function changeScoreQ6A1() {
                    x6 = 0;
                    document.getElementById("diemcau6").innerHTML = "Câu 6: " + x6 + " điểm";
                }

                function changeScoreQ6A2() {
                    x6 = 1;
                    document.getElementById("diemcau6").innerHTML = "Câu 6: " + x6 + " điểm";
                }

                function changeScoreQ6A3() {
                    x6 = 2;
                    document.getElementById("diemcau6").innerHTML = "Câu 6: " + x6 + " điểm";
                }

                function changeScoreQ6A4() {
                    x6 = 3;
                    document.getElementById("diemcau6").innerHTML = "Câu 6: " + x6 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header7 = document;
                var btns7 = header7.getElementsByClassName("button7");
                for (var i7 = 0; i7 < btns7.length; i7++) {
                    btns7[i7].addEventListener("click", function() {
                        var current7 = document.getElementsByClassName("active7");
                        current7[0].className = current7[0].className.replace(" active7", "");
                        this.className += " active7";
                    });
                }

                var x7 = 0;

                function changeScoreQ7A1() {
                    x7 = 0;
                    document.getElementById("diemcau7").innerHTML = "Câu 7: " + x7 + " điểm";
                }

                function changeScoreQ7A2() {
                    x7 = 1;
                    document.getElementById("diemcau7").innerHTML = "Câu 7: " + x7 + " điểm";
                }

                function changeScoreQ7A3() {
                    x7 = 2;
                    document.getElementById("diemcau7").innerHTML = "Câu 7: " + x7 + " điểm";
                }

                function changeScoreQ7A4() {
                    x7 = 3;
                    document.getElementById("diemcau7").innerHTML = "Câu 7: " + x7 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header8 = document;
                var btns8 = header8.getElementsByClassName("button8");
                for (var i8 = 0; i8 < btns8.length; i8++) {
                    btns8[i8].addEventListener("click", function() {
                        var current8 = document.getElementsByClassName("active8");
                        current8[0].className = current8[0].className.replace(" active8", "");
                        this.className += " active8";
                    });
                }

                var x8 = 0;

                function changeScoreQ8A1() {
                    x8 = 0;
                    document.getElementById("diemcau8").innerHTML = "Câu 8: " + x8 + " điểm";
                }

                function changeScoreQ8A2() {
                    x8 = 1;
                    document.getElementById("diemcau8").innerHTML = "Câu 8: " + x8 + " điểm";
                }

                function changeScoreQ8A3() {
                    x8 = 2;
                    document.getElementById("diemcau8").innerHTML = "Câu 8: " + x8 + " điểm";
                }

                function changeScoreQ8A4() {
                    x8 = 3;
                    document.getElementById("diemcau8").innerHTML = "Câu 8: " + x8 + " điểm";
                }

                // Add active class to the current button (highlight it)
                var header9 = document;
                var btns9 = header9.getElementsByClassName("button9");
                for (var i9 = 0; i9 < btns9.length; i9++) {
                    btns9[i9].addEventListener("click", function() {
                        var current9 = document.getElementsByClassName("active9");
                        current9[0].className = current9[0].className.replace(" active9", "");
                        this.className += " active9";
                    });
                }

                var x9 = 0;

                function changeScoreQ9A1() {
                    x9 = 0;
                    document.getElementById("diemcau9").innerHTML = "Câu 9: " + x9 + " điểm";
                }

                function changeScoreQ9A2() {
                    x9 = 1;
                    document.getElementById("diemcau9").innerHTML = "Câu 9: " + x9 + " điểm";
                }

                function changeScoreQ9A3() {
                    x9 = 2;
                    document.getElementById("diemcau9").innerHTML = "Câu 9: " + x9 + " điểm";
                }

                function changeScoreQ9A4() {
                    x9 = 3;
                    document.getElementById("diemcau9").innerHTML = "Câu 9: " + x9 + " điểm";
                }



                var x10 = 0;

                function changeScoreQ10A1() {
                    x10 = 0;
                    document.getElementById("diemcau10").innerHTML = "Câu 10: " + x10 + " điểm";
                }

                function changeScoreQ10A2() {
                    x10 = 1;
                    document.getElementById("diemcau10").innerHTML = "Câu 10: " + x10 + " điểm";
                }

                function changeScoreQ10A3() {
                    x10 = 2;
                    document.getElementById("diemcau10").innerHTML = "Câu 10: " + x10 + " điểm";
                }

                function changeScoreQ10A4() {
                    x10 = 3;
                    document.getElementById("diemcau10").innerHTML = "Câu 10: " + x10 + " điểm";
                }

                function fadeCauhoi10() {
                    const element = document.querySelector('.cauhoi10')
                    element.classList.add('animated', 'fadeOutDown')
                    element.addEventListener('animationend', function() {
                        hienKetqua()
                    })
                }

                function hienKetqua() {
                    document.getElementById("cauhoi10").style.display = 'none';
                    document.getElementById("mainDiv3").style.display = 'block';
                    const element = document.querySelector('.main33')
                    element.classList.add('animated', 'fadeInDown')
                }
            </script>
            <a class="but" href="javascript:fadeCauhoi10();window.tongdiem2 = x1 + x2 + x3 + x4 + x5 + x6 + x7 + x8 +x9 + x10;if (window.tongdiem2 < 5) {
			funcsion3()
		} else if (window.tongdiem2 >= 5) {
			funcsion4()
		}document.getElementById('tongdiemcuaban').innerHTML = window.tongdiem2;" style="margin-top: 25px">Tiếp tục <i class="fas fa-chevron-right"></i></a>
        </div>
        <style type="text/css">
            svg {
                width: 100px;
                display: block;
                margin: 40px auto 0;
            }
            
            .path {
                stroke-dasharray: 1000;
                stroke-dashoffset: 0;
                &.circle {
                    -webkit-animation: dash .9s ease-in-out;
                    animation: dash .9s ease-in-out;
                }
                &.line {
                    stroke-dashoffset: 1000;
                    -webkit-animation: dash .9s .35s ease-in-out forwards;
                    animation: dash .9s .35s ease-in-out forwards;
                }
                &.check {
                    stroke-dashoffset: -100;
                    -webkit-animation: dash-check .9s .35s ease-in-out forwards;
                    animation: dash-check .9s .35s ease-in-out forwards;
                }
            }
            
            @-webkit-keyframes dash {
                0% {
                    stroke-dashoffset: 1000;
                }
                100% {
                    stroke-dashoffset: 0;
                }
            }
            
            @keyframes dash {
                0% {
                    stroke-dashoffset: 1000;
                }
                100% {
                    stroke-dashoffset: 0;
                }
            }
            
            @-webkit-keyframes dash-check {
                0% {
                    stroke-dashoffset: -100;
                }
                100% {
                    stroke-dashoffset: 900;
                }
            }
            
            @keyframes dash-check {
                0% {
                    stroke-dashoffset: -100;
                }
                100% {
                    stroke-dashoffset: 900;
                }
            }

.ui-error{
	&-circle{
		stroke-dasharray:260.75219024795285px, 260.75219024795285px;
		stroke-dashoffset: 260.75219024795285px;
		animation: ani-error-circle 1.2s linear;
	}
	&-line1{
		stroke-dasharray: 54px 55px;
		stroke-dashoffset: 55px;
		stroke-linecap: round;
		animation: ani-error-line .15s 1.2s linear both;
	}
	&-line2{
		stroke-dasharray: 54px 55px;
		stroke-dashoffset: 55px;
		stroke-linecap: round;
		animation: ani-error-line .2s .9s linear both;
	}
}

@keyframes ani-error-line{
	to { stroke-dashoffset: 0; }
}

 @keyframes ani-error-circle {
		0% {
				stroke-dasharray: 0, 260.75219024795285px;
				stroke-dashoffset: 0;
		}
		35% {
				stroke-dasharray: 120px, 120px;
				stroke-dashoffset: -120px;
		}
		70% {
				stroke-dasharray: 0, 260.75219024795285px;
				stroke-dashoffset: -260.75219024795285px;
		}
		100% {
				stroke-dasharray: 260.75219024795285px, 0;
				stroke-dashoffset: -260.75219024795285px;
		}
}
.demo1 {
	height: 300px;
	display: flex;
	justify-content: center;
	align-items: center;
}
.ui-success,.ui-error {
	width: 100px; height: 100px;
	margin: 40px;
	// border:1px solid #eee;
}

.ui-success{
	&-circle {
		stroke-dasharray: 260.75219024795285px, 260.75219024795285px;
    stroke-dashoffset: 260.75219024795285px;
    transform: rotate(220deg);
    transform-origin: center center;
		stroke-linecap: round;
		animation: ani-success-circle 1s ease-in both;
	}
	&-path {
		stroke-dasharray: 60px 64px;
    stroke-dashoffset: 62px;
		stroke-linecap: round;
		animation: ani-success-path .4s 1s ease-in both;
	}
}
@keyframes ani-success-circle {
	to{stroke-dashoffset: 782.2565707438586px;}
}

@keyframes ani-success-path {
	0% {stroke-dashoffset: 62px;}
	65% {stroke-dashoffset: -5px;}
	84%{stroke-dashoffset: 4px;}
	100%{stroke-dashoffset: -2px;}
}

.ui-error{
	&-circle{
		stroke-dasharray:260.75219024795285px, 260.75219024795285px;
		stroke-dashoffset: 260.75219024795285px;
		animation: ani-error-circle 1.2s linear;
	}
	&-line1{
		stroke-dasharray: 54px 55px;
		stroke-dashoffset: 55px;
		stroke-linecap: round;
		animation: ani-error-line .15s 1.2s linear both;
	}
	&-line2{
		stroke-dasharray: 54px 55px;
		stroke-dashoffset: 55px;
		stroke-linecap: round;
		animation: ani-error-line .2s .9s linear both;
	}
}

@keyframes ani-error-line{
	to { stroke-dashoffset: 0; }
}

 @keyframes ani-error-circle {
		0% {
				stroke-dasharray: 0, 260.75219024795285px;
				stroke-dashoffset: 0;
		}
		35% {
				stroke-dasharray: 120px, 120px;
				stroke-dashoffset: -120px;
		}
		70% {
				stroke-dasharray: 0, 260.75219024795285px;
				stroke-dashoffset: -260.75219024795285px;
		}
		100% {
				stroke-dasharray: 260.75219024795285px, 0;
				stroke-dashoffset: -260.75219024795285px;
		}
}

        </style>
        <div class="mainDiv main33 mainDivresult2" style="zoom: 0.893;display: none;" id="mainDiv3">

<div class="demo1" id="crossma">
	<div class="ui-success">
		<svg viewBox="0 0 87 87" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
						<g id="Group-3" transform="translate(2.000000, 2.000000)">
							<circle id="Oval-2" stroke="rgba(165, 220, 134, 0.2)" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
								<circle  class="ui-success-circle" id="Oval-2" stroke="#A5DC86" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
								<polyline class="ui-success-path" id="Path-2" stroke="#A5DC86" stroke-width="4" points="19 38.8036813 31.1020744 54.8046875 63.299221 28"></polyline>
						</g>
				</g>
		</svg>
	</div>
	
	<div class="ui-error">
		<svg  viewBox="0 0 87 87" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
			<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="Group-2" transform="translate(2.000000, 2.000000)">
						<circle id="Oval-2" stroke="rgba(252, 191, 191, .5)" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
						<circle  class="ui-error-circle" stroke="#F74444" stroke-width="4" cx="41.5" cy="41.5" r="41.5"></circle>
							<path class="ui-error-line1" d="M22.244224,22 L60.4279902,60.1837662" id="Line" stroke="#F74444" stroke-width="3" stroke-linecap="square"></path>
							<path class="ui-error-line2" d="M60.755776,21 L23.244224,59.8443492" id="Line" stroke="#F74444" stroke-width="3" stroke-linecap="square"></path>
					</g>
			</g>
	</svg>
	</div>
</div>

            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" id="checkma" style="display: none;margin-top: 50px;margin-bottom: 0px" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
            <h3 id="tunnaa2" style="margin-top: 20px">Tunna</h3>
            <br>
            <a href="javascript:fadeKetqua2();mucdocuaban2();" style="color: #7b7b7b;">Xem lý do tại sao và thông tin chi tiết</a>
        </div>
    </center>
    <br>
    <div class="mainDivketqua" style="zoom: 0.893;display: none;" id="seewhyandinfo">
        <br>
        <center>
            <p style="margin-bottom: 0">Tổng điểm của bạn:</p>
            <h1 id="tongdiemcuaban"></h1>
            <br>
            <p style="margin-bottom: 0">Mức độ trầm cảm:</p>
            <h3 id="mucdocuaban"></h3>
            <br>
            <p style="margin-bottom: 0">Lời khuyên:</p>
            <h5 id="loikhuyen"></h5>
            <br>
            <p style="margin-bottom: 0">Hướng xử lí:</p>
            <h5 id="huongxuli"></h5>
            <br>
        </center>
        <hr style="margin-bottom: 0.5rem;">
        <div>
            <a href="#" data-toggle="collapse" data-target="#diachivasdt" style="color: #3f7dbf;">Hiện địa chỉ và số điện thoại phòng khám</a>
        </div>
        <div id="diachivasdt" class="collapse">
            <span style="font-size: 20px;">Trung tâm phục hồi chức năng chăm sóc sức khỏe tâm thần cộng đồng</span><br>
            <span><b><i class="fas fa-map-marker-alt"></i> Địa chỉ:</b> Bệnh viện Tâm thần trung ương 1, Hoà Bình, Thường Tín, Hà Nội</span><br>
            <span><b><i class="fas fa-phone-alt"></i> Số điện thoại:</b> 0913988796 - Tiến sĩ Cao Thị Vịnh</span>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1864.0367799816959!2d105.84147777194164!3d20.869085105035715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjDCsDUyJzA4LjciTiAxMDXCsDUwJzMyLjYiRQ!5e0!3m2!1svi!2sus!4v1623640555276!5m2!1svi!2sus" width="393" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div>
            <a href="#" data-toggle="collapse" data-target="#diemchitiet" style="color: #3f7dbf;">Hiện số điểm chi tiết</a>
        </div>
        <div id="diemchitiet" class="collapse">
            <p id="diemcau1" style="margin-bottom: 0"></p>
            <p id="diemcau2" style="margin-bottom: 0"></p>
            <p id="diemcau3" style="margin-bottom: 0"></p>
            <p id="diemcau4" style="margin-bottom: 0"></p>
            <p id="diemcau5" style="margin-bottom: 0"></p>
            <p id="diemcau6" style="margin-bottom: 0"></p>
            <p id="diemcau7" style="margin-bottom: 0"></p>
            <p id="diemcau8" style="margin-bottom: 0"></p>
            <p id="diemcau9" style="margin-bottom: 0"></p>
            <p id="diemcau10" style="margin-bottom: 0"></p>
        </div>
        <div style="margin-bottom: 10px;">
            <a href="#" data-toggle="collapse" data-target="#huongdan" style="color: #3f7dbf;">Hiện hướng dẫn và bảng điểm chi tiết</a>
        </div>
        <div id="huongdan" class="collapse">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 68px;">Tổng điểm</th>
                        <th>Mức độ</th>
                        <th>Hướng xử lí</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0-4</td>
                        <td>Không</td>
                        <td>Không</td>
                    </tr>
                    <tr>
                        <td>5-9</td>
                        <td>Nhẹ</td>
                        <td>Theo dõi, đánh giá lại PHQ-9 khi tái khám</td>
                    </tr>
                    <tr>
                        <td>10-14</td>
                        <td>Vừa</td>
                        <td>Điều trị gồm tư vấn, theo dõi và có thể dùng thuốc</td>
                    </tr>
                    <tr>
                        <td>15-19</td>
                        <td>Nặng vừa</td>
                        <td>Điều trị thuốc ngay, có thể kết hợp liệu pháp tâm lý</td>
                    </tr>
                    <tr>
                        <td>20-27</td>
                        <td>Nặng</td>
                        <td>Điều trị thuốc ngay, và nếu bệnh nhân đáp ứng kém với điều trị, nên tiến hành chuyển bệnh nhân đến khám chuyên tâm thần để được điều trị bằng liệu pháp tâm lý và/hoặc kết hợp trị liệu</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="overflow: hidden">
            <button type="button" class="btn btn-light lamlai" style="border-radius: 50px;float: left" onclick="location.reload();"><i class="fas fa-redo"></i> Làm lại trắc nghiệm</button>
            <button type="button" class="btn btn-light share" style="border-radius: 50px;float: right" onclick="hideKetqua()"><i class="fas fa-share-square"></i> Chia sẻ</button>
        </div>
    </div>

    <script>
        function hideKetqua() {
            const element = document.querySelector('#mainDiv3')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                share();
                document.getElementById('center1').style.display = 'none';
            })
        }

        function mucdocuaban2() {
            if (window.tongdiem2 >= 0 && window.tongdiem2 <= 4) {
                document.getElementById('mucdocuaban').innerHTML = 'Không';
                document.getElementById('huongxuli').innerHTML = 'Không có';
            } else if (window.tongdiem2 >= 5 && window.tongdiem2 <= 9) {
                document.getElementById('mucdocuaban').innerHTML = 'Nhẹ';
                document.getElementById('huongxuli').innerHTML = 'Theo dõi, đánh giá lại PHQ-9 khi tái khám';
            } else if (window.tongdiem2 >= 10 && window.tongdiem2 <= 14) {
                document.getElementById('mucdocuaban').innerHTML = 'Vừa';
                document.getElementById('huongxuli').innerHTML = 'Điều trị gồm tư vấn, theo dõi và có thể dùng thuốc';
            } else if (window.tongdiem2 >= 15 && window.tongdiem2 <= 19) {
                document.getElementById('mucdocuaban').innerHTML = 'Nặng vừa';
                document.getElementById('huongxuli').innerHTML = 'Điều trị thuốc ngay, có thể kết hợp liệu pháp tâm lý';
            } else if (window.tongdiem2 >= 20 && window.tongdiem2 <= 30) {
                document.getElementById('mucdocuaban').innerHTML = 'Nặng';
                document.getElementById('huongxuli').innerHTML = 'Điều trị thuốc ngay, và nếu bệnh nhân đáp ứng kém với điều trị, nên tiến hành chuyển bệnh nhân đến khám chuyên tâm thần để được điều trị bằng liệu pháp tâm lý và/hoặc kết hợp trị liệu';
            }
        }

        function mucdocuaban() {
            if (window.tongdiem1 >= 0 && window.tongdiem1 <= 4) {
                document.getElementById('mucdocuaban').innerHTML = 'Không';
                document.getElementById('huongxuli').innerHTML = 'Không có';
            } else if (window.tongdiem1 >= 5 && window.tongdiem1 <= 9) {
                document.getElementById('mucdocuaban').innerHTML = 'Nhẹ';
                document.getElementById('huongxuli').innerHTML = 'Theo dõi, đánh giá lại PHQ-9 khi tái khám';
            } else if (window.tongdiem1 >= 10 && window.tongdiem1 <= 14) {
                document.getElementById('mucdocuaban').innerHTML = 'Vừa';
                document.getElementById('huongxuli').innerHTML = 'Điều trị gồm tư vấn, theo dõi và có thể dùng thuốc';
            } else if (window.tongdiem1 >= 15 && window.tongdiem1 <= 19) {
                document.getElementById('mucdocuaban').innerHTML = 'Nặng vừa';
                document.getElementById('huongxuli').innerHTML = 'Điều trị thuốc ngay, có thể kết hợp liệu pháp tâm lý';
            } else if (window.tongdiem1 >= 20 && window.tongdiem1 <= 30) {
                document.getElementById('mucdocuaban').innerHTML = 'Nặng';
                document.getElementById('huongxuli').innerHTML = 'Điều trị thuốc ngay, và nếu bệnh nhân đáp ứng kém với điều trị, nên tiến hành chuyển bệnh nhân đến khám chuyên tâm thần để được điều trị bằng liệu pháp tâm lý và/hoặc kết hợp trị liệu';
            }
        }

        document.getElementById("diemcau1").innerHTML = "Câu 1: 0 điểm";
        document.getElementById("diemcau2").innerHTML = "Câu 2: 0 điểm";
        document.getElementById("diemcau3").innerHTML = "Câu 3: 0 điểm";
        document.getElementById("diemcau4").innerHTML = "Câu 4: 0 điểm";
        document.getElementById("diemcau5").innerHTML = "Câu 5: 0 điểm";
        document.getElementById("diemcau6").innerHTML = "Câu 6: 0 điểm";
        document.getElementById("diemcau7").innerHTML = "Câu 7: 0 điểm";
        document.getElementById("diemcau8").innerHTML = "Câu 8: 0 điểm";
        document.getElementById("diemcau9").innerHTML = "Câu 9: 0 điểm";
        document.getElementById("diemcau10").innerHTML = "Câu 10: 0 điểm";

        function getdiem() {
            if (testTaken == "FT") {
                document.getElementById("diemcau3").innerHTML = "Câu 3: Chưa trả lời";
                document.getElementById("diemcau4").innerHTML = "Câu 4: Chưa trả lời";
                document.getElementById("diemcau5").innerHTML = "Câu 5: Chưa trả lời";
                document.getElementById("diemcau6").innerHTML = "Câu 6: Chưa trả lời";
                document.getElementById("diemcau7").innerHTML = "Câu 7: Chưa trả lời";
                document.getElementById("diemcau8").innerHTML = "Câu 8: Chưa trả lời";
                document.getElementById("diemcau9").innerHTML = "Câu 9: Chưa trả lời";
                document.getElementById("diemcau10").innerHTML = "Câu 10: Chưa trả lời";
            }
        }

        function fadeKetqua1() {
            testTaken = 'FT';
            const element = document.querySelector('#mainDiv2')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                seeWhy();
                getdiem();
                document.getElementById('center1').style.display = 'none';
            })
        }

        function fadeKetqua2() {
            testTaken = 'PHQ-9';
            const element = document.querySelector('#mainDiv3')
            element.classList.add('animated', 'fadeOutDown')
            element.addEventListener('animationend', function() {
                seeWhy();
                getdiem();
                document.getElementById('center1').style.display = 'none';
            })
        }

        function seeWhy() {
            document.getElementById("mainDiv2").style.display = 'none';
            document.getElementById("seewhyandinfo").style.display = 'block';
            const element = document.querySelector('#seewhyandinfo')
            element.classList.add('animated', 'fadeInDown')
        }

        function funcsion3() {
            var thongb2 = 'Cảm xúc của bạn tốt';
            document.getElementById("tunnaa2").innerHTML = thongb2;
            document.getElementById("loikhuyen").innerHTML = thongb2 + ". Bạn không có biểu hiện của bệnh, khả năng thích nghi của cơ thể và tinh thần tốt.";
            document.getElementById("checkma").style.display = 'block';
        }

        function funcsion4() {
            var thongb2 = 'Vui lòng đến gặp bác sĩ chuyên khoa để được khám và tư vấn phù hợp';
            document.getElementById("tunnaa2").innerHTML = thongb2;
            document.getElementById("loikhuyen").innerHTML = thongb2;
            document.getElementById("crossma").style.display = 'block';
        }

        // Restricts input for the given textbox to the given inputFilter function.
        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            });
        }
        setInputFilter(document.getElementById("intLimitTextBox"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 100);
        });
    </script>
</body>
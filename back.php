<?php include_once "base.php"; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0055)?do=admin -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>影城</title>
    <link rel="stylesheet" href="css/css.css">
    <link href="css/s2.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-1.9.1.min.js"></script>
</head>

<body>
    <div id="main">
        <div id="top" style=" background:#999 center; background-size:cover; " title="替代文字">
            <h1>ABC影城</h1>
        </div>
        <div id="top2">
            <a href="index.php">首頁</a>
            <a href="index.php?do=order">線上訂票</a>
            <a href="#">會員系統</a>
            <a href="back.php">管理系統</a>
        </div>
        <div id="text"> <span class="ct">最新活動</span>
            <marquee direction="right">
                ABC影城票價全面八折優惠1個月
            </marquee>
        </div>
        <div id="mm">
            <!-- 整段的意思是我會先在上面(在判斷要載入哪個檔案之前)，先去判斷登入的動作
            決定要不要出現錯誤訊息(登入失敗)，還是要把登入的狀態載入(登入成功)
            我上面如果有建立session的話，下面就去判斷這個session存不存在(來決定我要載入那些東西)
            載入的東西一個是navbar(我的選單)，另外一個是我的功能(選單所對應到的功能的我的檔案) -->
            <?php

            //  session_start();  base.php已經引入了所以這裡可以刪掉了
            //  本來寫if (!isset($_POST)) {  但後來發現不行
            //  因為$_POST是系統變數，所以它無論如何都會存在,我們改看(要看的是)裡面有沒有東西
            //  如果裡面是空的的話我再來做這個這個判斷
            //  其實這段我也可以放在最上面，但因為我們想要帳號或密碼錯誤這段，所以還是在下面的表單之前處理會比較好
            if (!empty($_POST)) {
                if ($_POST['acc'] == 'admin' && $_POST['pw'] == '1234') {
                    $_SESSION['login'] = 'admin';
                    // $_SESSION['login'] = 1;  這樣寫也可以，因為我只是要這個變數在而已，不管它值的內容
                } else {
                    echo "<div class='ct' style='color:red'>帳號或密碼錯誤</div>";
                }
            }


            // 在這邊去判斷你有沒有登入的事情
            if (isset($_SESSION['login'])) {
                // 有登入的話你就可以看到內容(選單列)
                include "back/nav.php";


                // $do=$_GET['do']??'main';
                $do = $_GET['do'] ?? ''; //給它空字串，反正沒有這個檔案就會顯示請選擇所需功能
                //因為我現在是放在back.php(本來放在back/main.php)，我有include檔案
                $file="back/".$do.".php";  //所以我要加上對應檔案的路徑

                //本來這邊有一個判斷式，但因為我接下來不需要用main來判斷要載入哪一塊的問題
                //(我已經改在back.php做處理了)所以就刪掉if($do!='main')的判斷式了

                if (file_exists($file)) {
                    // 如果檔案存在就幫我include
                    include $file;
                } else {
                    // 如果檔案沒有存在的話
                    include "back/main.php";
                }
            } else {
                // 沒有登入的話就給你登入畫面
                include "back/login.php";
            }

            ?>

        </div>
        <div id="bo"> ©Copyright 2010~2014 ABC影城 版權所有 </div>
    </div>
</body>

</html>
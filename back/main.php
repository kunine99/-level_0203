測試
<!-- 如果你有登入就看到這一坨，沒登入就看到登入畫面  這個方法不行，不要用，改用session-->
<?php
//  session_start();  base.php已經引入了所以這裡可以刪掉了
//  本來寫if (!isset($_POST)) {  但後來發現不行
//  因為$_POST是系統變數，所以它無論如何都會存在,我們改看(要看的是)裡面有沒有東西
//  如果裡面是空的的話我再來做這個這個判斷
if (!empty($_POST)) {
    if ($_POST['acc'] == 'admin' && $_POST['pw'] == '1234') {
        $_SESSION['login'] = 'admin';
        // $_SESSION['login'] = 1;  這樣寫也可以，因為我只是要這個變數在而已，不管它值的內容
    } else {
        echo "<div class='ct' style='color:red'>帳號或密碼錯誤</div>";
    }
}
?>
<?php
if (isset($_SESSION['login'])) {
?>
<div class="ct a rb" style="position:relative; width:101.5%; left:-1%; padding:3px; top:-9px;">
    <a href="?do=title">網站標題管理</a>|
    <a href="?do=go">動態文字管理</a>|
    <a href="?do=poster">預告片海報管理</a>|
    <a href="?do=movie">院線片管理</a>|
    <a href="?do=order">電影訂票管理</a>
</div>
<?php
    // $do=$_GET['do']??'main';
    $do = $_GET['do'] ?? ''; //給它空字串，反正沒有這個檔案就會顯示請選擇所需功能
    if ($do != 'main') {
        $file = 'back/' . $do . ".php";
    } else {
        $file = ''; // 寫成$file = 'aaa';也可以，反正就是故意給他一個錯誤的檔案
    }
    if (file_exists($file)) {
        // 如果檔案存在就幫我include
        include $file;
    } else {
        // 如果檔案沒有存在的話
        echo "<div class='rb tab'>";
        echo "<h2 class='ct'>請選擇所需功能</h2>";
        echo "</div>";
    }
    ?>
<div class="rb tab">
    <h2 class="ct">請選擇所需功能</h2>
</div>
<?php
} else {
?>
<!-- 登入畫面 -->
<form action="back.php" method="post">
    <table class="tab">
        <tr>
            <td>帳號:</td>
            <td><input type="text" name="acc"></td>
        </tr>
        <tr>
            <td>密碼:</td>
            <td><input type="password" name="pw"></td>
        </tr>
        <tr>
            <td><input type="submit" value="登入"></td>
            <td></td>
        </tr>
    </table>
</form>
<?php
}
?>
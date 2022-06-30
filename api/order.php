<?php include_once "../base.php";

$movie=$Movie->find($_POST['id']);
$date=$_POST['date'];
// 我現在拿到的只是表單上的12345,所以我們還是要把他轉成$_POST['session']
$session=$ss[$_POST['session']];
//給座位做排序,因為使用者可能點座位會隨便點,
//這樣直接放的話可能會呈現你訂了1-1,4-3,2-1
//我們讓他排序成1-1,2-1,4-3這樣比較好看
//sort會直接改變陣列的內容,但不會回傳陣列本身
sort($_POST['seats']);
$seats=$_POST['seats'];
//先找到這筆資料的id,max找到id這個欄位 最大值是多少?再+1,就是我預設這筆新增訂單的id
$id=$Ord->math("max","id")+1;
// 流水號日期八碼+id(要4位數補0)
//"%04d" 告訴他你這個字要什麼樣子,我要的是百分之%04,我要用0開頭然後他要補4位數,補id進去,他就會幫你補4位數進來
$no=date("Ymd") . sprintf("%04d",$id);

// 用陣列把東西帶進去
//session已經用$ss轉成字串了
//座位用serialize轉成字串
//qt就是我的座位的數量
$Ord->save([
    'no'=>$no,
    'movie'=>$movie['name'],
    'date'=>$date,
    'session'=>$session,
    'seat'=>serialize($seats),
    'qt'=>count($seats)
]);

?>

<style>
    /* 直接複製front/order.php去修改 */
    #order{
        width:60%;
        margin:auto;
    }
    .row{
        display:flex;
        width:100%;
    }
    .row .first{
        width:20%;
        text-align:right;
    }
    .row .sec{
        width:85%;
        text-align:left;
    }
    .sec select{
        width:100%;
    }

</style>
<div id="order">
<div class="row">
    <div class="sec">
        感謝您的訂購，您的訂單編號是：<?=$no;?>
    </div>

</div>
<div class="row">
    <div class="first">電影名稱：</div>
    <div class="sec">
        <?=$movie['name'];?>
    </div>
</div>
<div class="row">
    <div class="first">日期：</div>
    <div class="sec">
        <?=$date;?>
    </div>
</div>
<div class="row">
    <div class="first">場次時間：</div>
    <div class="sec">
        <?=$session;?>
    </div>
</div>
<div class="row">
    <div class="sec">
        座位:<br>
        <?php
        foreach($seats as $seat){
            // 是$seat不是$i 記得改
           echo  (floor($seat/5)+1). "排".($seat%5 +1)."號";
           echo "<br>";
        }

        ?>
        <!-- 因為我在同一個檔案,所以我可以幫剛剛叫出來的變數再拿出來用 -->
        共<?=count($seats);?>張電影票
    </div>
</div>
<div class="row">
    <div class="ct" style="width:100%">
    <!-- 實務上這邊要注意確認後要去哪裡喔 -->
        <button onclick="location.href='index.php'">確認</button>
    </div>

</div>
</div>
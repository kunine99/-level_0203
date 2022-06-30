<?php
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];
$session=$ss[$_GET['session']];
?>

<style>
#seats {
    display: flex;
    flex-wrap: wrap;
    width:540px;
    height:370px;
    /* 上右下左 */
    padding:19px 112px 12px 112px;
    margin:auto;
    background:url('icon/03D04.png');
    /* 加box-sizing:border-box才不會被padding影響我的總寬度 */
    box-sizing:border-box;
}

.seat {
    width: 63px;
    height: 85px;
    position:relative;
}

/* 沒有人的座位 */
.null{
    background:url('icon/03D02.png');
    background-position:center;
    background-repeat:no-repeat;
}
/* 有人的座位 */
.booked{
    /* 不是從api/booking來看,因為我是從index.php包進去的 */
    background:url('icon/03D03.png');
    /* 上面中間 */
    background-position:center;
    background-repeat:no-repeat;
}


.check{
    /* position:absolute會去找上層的relative來做定位,如果他網上找都找不到,就會找body */
    position:absolute;
    right:5px;
    bottom:5px;
}
</style>

<div id="seats">
    <?php
    //我有20個座位(不寫=20是因為這樣會變成21個)
    for($i=0;$i<20;$i++){
        echo "<div class='seat null'>";
        echo "  <div class='ct'>";
        //(取除數,然後因為我最小是0,可是我最小是1,所以這邊要再加1). "排"
        //(算餘數+1  因為我從0開始算,所以我的第一個值都是0,0+1我就會得到這個幾號)."號"
        echo    (floor($i/5)+1). "排".($i%5 +1)."號";
        echo "  </div>";
        echo "<input type='checkbox' name='check' class='check' value='$i'>";
        echo "</div>";
    }
    ?>
</div>

<div style="width:540px;margin:auto">
    <div>您選擇的電影是：<?=$movie['name'];?></div>
    <div>您選擇的時刻是：<?=$date;?> <?=$session;?></div>
    <div>您已經勾選了<span id="tickets"></span>張票，最多可以購買四張票</div>
    <div>
        <button onclick="prev()">回上一步</button>
        <button >完成訂購</button>
    </div>
</div>
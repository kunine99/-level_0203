<?php 
include_once "../base.php";
// 複製來自get_days.php
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];



// 我一天有五場
for($i=1;$i<=5;$i++){
    //場次內容$i
    //因為$ss是陣列,所以用大誇號誇起來
    //用陣列的方式把session的值跟key帶進來
    // echo "<option value='$i'>{$ss[$i]} 剩餘座位 </option>";

    //檢查剩餘座位有沒有正常,我們就要先撈出所有的電影的時間的場次的座位數
    //我要去計算qt欄位總共有幾個,條件式我的'movie'要是我的$movie的名稱,今天的日期,還有每一個場次的剩餘座位(不是整天的場次喔)
    //$ss[$i就是場次的資料
    $seats=$Ord->math('sum','qt',['movie'=>$movie['name'],'date'=>$date,'session'=>$ss[$i]]);
    echo "<option value='$i'>{$ss[$i]} 剩餘座位 ".(20-$seats)."</option>";

}
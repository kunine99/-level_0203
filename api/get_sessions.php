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
    echo "<option value='$i'>{$ss[$i]} 剩餘座位 </option>";
}
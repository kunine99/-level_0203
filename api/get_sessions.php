<?php 
include_once "../base.php";
// 複製來自get_days.php
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];

$ss=[1=>'14:00~16:00',
     2=>'16:00~18:00',
     3=>'18:00~20:00',
     4=>'20:00~22:00',
     5=>'22:00~24:00',
];

// 我一天有五場
for($i=1;$i<=5;$i++){
    //場次內容$i
    //因為$ss是陣列,所以用大誇號誇起來
    //用陣列的方式把session的值跟key帶進來
    echo "<option value='$i'>{$ss[$i]} 剩餘座位 </option>";
}
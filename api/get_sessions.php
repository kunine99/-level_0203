<?php 
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];

$ss=[1=>'14:00~16:00',
     2=>'16:00~18:00',
     3=>'18:00~20:00',
     4=>'20:00~22:00',
     5=>'22:00~24:00',
];

for($i=1;$i<=5;$i++){
    echo "<option value='$i'>{$ss[$i]} 剩餘座位 </option>";
}
<?php 
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];



for($i=1;$i<=5;$i++){
    $seats=$Ord->math('sum','qt',['movie'=>$movie['name'],'date'=>$date,'session'=>$ss[$i]]);
    echo "<option value='$i'>{$ss[$i]} 剩餘座位 ".(20-$seats)."</option>";
}
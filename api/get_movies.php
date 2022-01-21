<?php 
include_once "../base.php";
$id=$_GET['id'];
// front/movie.php 複製來的
$today=date("Y-m-d");
$ondate=date("Y-m-d",strtotime("-2 days"));
// $id等於我用get取得的資料

$movies=$Movie->all(" where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today'");
foreach($movies as $movie){
    $selected=($movie['id']==$id)?"selected":"";
    // 如果我的$movie id等於....就讓它呈現空值的狀態?
    echo "<option value='{$movie['id']}' $selected>{$movie['name']}</option>";
}
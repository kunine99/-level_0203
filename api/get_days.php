<?php 
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$finaldate=strtotime("+2 days",strtotime($movie['ondate']));
// 拿到時間後要小心，他拿到的是開始還是結束
$gap=($finaldate-strtotime(date("Y-m-d")))/(60*60*24);


for($i=0;$i<=$gap;$i++){
    // 如果想算整數，stringtotime去轉date
    $date=date("Y-m-d",strtotime("+$i days"));
    echo "<option value='$date'>$date</option>";
}

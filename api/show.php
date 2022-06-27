<?php 
include_once "../base.php";
// 因為我們只丟id過來,所以就不用取變數了直接用比較快


$movie=$Movie->find($_POST['id']);
/* 
顯示變影藏,隱藏變顯示
    if($movie['sh']==1){
    $movie['sh']=0;
}else{
    $movie['sh']=1;
不過這樣寫有點遜
} */

// 如果你是0,1切換，甚至是0,1,2,3切換
// 如果你的東西有循環特性的話可以善用餘數來減少程式碼
// 這個東西是計算式，不會用到if else，比較快
$movie['sh']=($movie['sh']+1)%2;

$Movie->save($movie);
<?php
include_once "../base.php";
// 我要撈出來的電影有哪些?
// 基本上跟首頁顯示出來的院線片清單一樣
// (現實中可能可以訂到沒有在首頁的院線片清單的電影,不過這題不會)
// 接下來複製front/movie.php裡列出所有movie的條件式
// ↑這個條件式不需要分頁也不需要排序所以後面的條件可以刪除
// 記得$today跟$ondate也要複製 

$id=$_GET['id'];

$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));

$movies = $Movie->all(" where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today'");
//我們這段期間(上印期間)的電影要把它做成選項丟給前端
//讓他插入到我們的電影裡面去
foreach ($movies as $movie) {
    // 他會幫我們產生5部電影的清單,這個清單裡面要寫什麼呢?
    // 通常是放我電影裡面的$movie的id跟名稱
    // 在我做選項前他要去比對,如果我的$movie['id']的id剛好等於我傳進來的這個$id
    // 那就幫我呈現選中的狀態,不然的話就是空值的狀況
    $selected=($movie['id']==$id)?"selected":"";
    echo "<option value='{$movie['id']}' $selected>{$movie['name']}</option>";
    
}

//當我有個請求到api這邊,get movies要電影的資料
//我就會用這個方式倒出這段期間會上印的電影
//然後做成一個選項的清單,丟給前端
//前端收到之後,script就會幫我丟到id movie的select裡面去
//這樣我就會產生清單了
<?php include_once "../base.php";

$db=new DB($_POST['table']);

//我的id就是從post送過來的東西,這個id就是一個陣列,裡面有兩個東西,一個是當下的id一個是我要交換的id
//id0就是這個post送過來的id的第0個
$id0=$_POST['id'][0];
//id0就是這個post送過來的id的第1個
$id1=$_POST['id'][1];

//找出兩筆資料
$row0=$db->find($id0);
$row1=$db->find($id1);

//rank值做交換
//先把rank值給tmp
$tmp=$row0['rank'];
//$row0的['rank']值已經給出去了，所以我可以用$row1的['rank']值把它取代掉
$row0['rank']=$row1['rank'];
//再把$row1的['rank']給tmp
$row1['rank']=$tmp;

// 存回去
$db->save($row0);
$db->save($row1);
<?php include_once "../base.php";
// 我會拿到table的名字(由post傳過來的)
// $db->del($_POST['id']);
$db=new DB($_POST['table']);
echo $db->del($_POST['id']);
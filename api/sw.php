<?php include_once "../base.php";

$db=new DB($_POST['table']);

$id0=$_POST['id'][0];
$id1=$_POST['id'][1];

$row0=$db->find($id0);
$row1=$db->find($id1);

//rank交換 先把rank值給tmp
$tmp=$row0['rank'];
$row0['rank']=$row1['rank'];    //不用擔心被取代的問題 
$row1['rank']=$tmp;


$db->save($row0);
$db->save($row1);


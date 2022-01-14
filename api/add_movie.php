<?php include_once "../base.php";
//dd($_POST);
if(isset($_FILES['trailer']['tmp_name'])){
    $_POST['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$_POST['trailer']);
}

if(isset($_FILES['poster']['tmp_name'])){
    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$_POST['poster']);
}

//$_POST['ondate']=$_POST['year']. "-".$_POST['month']."-".$_POST['day'];
//   用- join　這個函式把它包起來
$_POST['ondate']=join("-",[$_POST['year'],$_POST['month'],$_POST['day']]);
$_POST['rank']=$Movie->math('max','id')+1;
$_POST['sh']=1;
// php 陣列 刪除元素  有3個方法1.unset(最直覺，推薦) 2.arry_splice 3.array_diff(兩個陣列做比較，把不相同的刪掉)
unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);
//dd要註解掉,不然可能會影響到後面to的功能
//dd($_POST);
$Movie->save($_POST);
to("../back.php?do=movie");





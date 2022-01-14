<?php include_once "../base.php";
//dd($_POST);
//dd($_FILES);
if(!empty($_FILES['trailer']['tmp_name'])){
    $_POST['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$_POST['trailer']);
}

if(!empty($_FILES['poster']['tmp_name'])){
    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$_POST['poster']);
}

//$_POST['ondate']=$_POST['year']. "-".$_POST['month']."-".$_POST['day'];
$_POST['ondate']=join("-",[$_POST['year'],$_POST['month'],$_POST['day']]);
$_POST['sh']=1;
unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);
//dd($_POST);
$Movie->save($_POST);
to("../back.php?do=movie");
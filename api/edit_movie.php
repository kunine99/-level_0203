<?php include_once "../base.php";

// 直接複製add_movie
// $_POST['rank']=$Movie->math('max','id')+1;   不要改排序，所以這行可刪除


// 用!empty，trailer就不會出來
// 用isset，trailer就會出來(變數就會存在，不過是空的，所以存回資料庫後原本的就會被洗掉)
// 我們選用!empty，如果它是空的表示上傳有成功
if(!empty($_FILES['trailer']['tmp_name'])){
    $_POST['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$_POST['trailer']);
}

if(!empty($_FILES['poster']['tmp_name'])){
    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$_POST['poster']);
}


$_POST['ondate']=join("-",[$_POST['year'],$_POST['month'],$_POST['day']]);

$_POST['sh']=1;

//php陣列 刪除元素 
unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);

//dd($_POST);
$Movie->save($_POST);
to("../back.php?do=movie");
<?php include_once "../base.php";
// 我們上傳了兩個東西 1.電影 2.海報所以這兩個都要做判斷

//dd($_POST);
//如果這個變數是存在的代表你有上傳成功,成功才會產生路徑,路徑才會存在變數裡面
if(isset($_FILES['trailer']['tmp_name'])){
    //上傳成功的話我要先拿到檔案的名字
    $_POST['trailer']=$_FILES['trailer']['name'];
    //從我暫存的位置($_FILES['trailer']['tmp_name']),搬到img這個目錄下面,然後我的檔案名稱就是 $_POST['trailer']
    move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$_POST['trailer']);
}

if(isset($_FILES['poster']['tmp_name'])){
    $_POST['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$_POST['poster']);
}

//$_POST['ondate']=$_POST['year']. "-".$_POST['month']."-".$_POST['day']; 另一個寫法
// join()跟implode()一樣   join(" ",[陣列]) 
$_POST['ondate']=join("-",[$_POST['year'],$_POST['month'],$_POST['day']]);
// copy api/add_poster
// 在存進資料庫前，先找出目前資料庫裡最大的id
// 然後理論上我新增的這筆資料是我最大的id+1
// $Movie這張表用math function,用max去找到id這個欄位(去找到我最大的id)
$_POST['rank']=$Movie->math('max','id')+1;
$_POST['sh']=1;

//php陣列 刪除元素 
unset($_POST['year']);
unset($_POST['month']);
unset($_POST['day']);

//dd($_POST);
$Movie->save($_POST);
to("../back.php?do=movie");
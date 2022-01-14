<?php include_once "../base.php";

foreach ($_POST['id'] as $key => $id){
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){

        $Poster->del($id);

}else{
    // 名字對應比數 id的key對應name的key
    $po=$Poster->find($id);
    $po['name']=$_POST['name'][$key];
    $po['ani']=$_POST['ani'][$key];
    // 如果sh顯示，那這筆資料就要顯示，不然他就是0(不顯示)
    $po['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;

    $Poster->save($po);





}}
to("../back.php?do=poster"); 

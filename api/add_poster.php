<?php include_once "../base.php";
//牽扯到資料庫所以include_once

// 先判斷圖片在不在，我現在的欄位名稱叫path，如果上傳有成功的話我會有一個tmp_name
if (isset($_FILES['path']['tmp_name'])) {
    // 圖片檔案的檔名(post的path)
    $data['path'] = $_FILES['path']['name'];
    //我要把檔案從剛才的tmp_name的地方搬到我現在外層的img目錄下，檔案名稱就是剛才的data的img
    move_uploaded_file($_FILES['path']['tmp_name'], '../img/' . $data['path']);
    // 如果檔案有上傳成功，表示我還會有一個資料是這個資料(預告片的名稱)

    // 預告片的名稱是 $_POST的name這個欄位
    $data['name'] = $_POST['name'];
    // 在存進資料庫前，先找出目前資料庫裡最大的id
    // 然後理論上我新增的這筆資料是我最大的id+1
    // $Poster這張表用math function,用max去找到id這個欄位(去找到我最大的id)
    $maxid = $Poster->math('max', 'id');
    //在存進去以前告訴她$data的['rank']這個欄位應該= $maxid + 1
    $data['rank'] = $maxid + 1;   //去測試後會發現，只要id不重複 rank就不會重複
    $Poster->save($data);
}

to("../back.php?do=poster");

<?php include_once "../base.php";
// 我的表單會送
// 1.電影名稱(name[]陣列)
// 2.顯示(sh[])
// 3.刪除(del[])
// 4.動畫是哪一種
// 5.id陣列
// (圖片不會送喔，沒有讓他能改)

//既然有id陣列，那我們就把他foreach出來
foreach ($_POST['id'] as $key => $id) {
    //如果這個陣列是存在表示有資料要被刪除 而且又很剛好要刪除的這筆id又在我的陣列裡面那就把他刪掉
    if(isset($_POST['del']) && in_array($id,$_POST['del'])){
        //$Poster請去刪掉傳過來的id的值
        $Poster->del($id);

    }else{
        // 如果沒有資料要刪除表示我要更改資料的內容
        // 先把他撈出來，這樣每個資料就都在裡面了
        $po=$Poster->find($id);

        //撈出來後我就告訴他，我會被修改的有名字
        //名字會=$_POST的['name']的欄位的對應的筆數，筆數是$key
        //我們會照著id的順序產生一個$_POST的name的陣列，這個陣列裡面的資料順序跟我的input hidden裡面的id的陣列是一樣的
        //所以id的key在哪裡，他就會對應到name的key的位置的資料
        //所以我就告訴他你要找的資料就在$_POST['name']對應的key的資料
        $po['name']=$_POST['name'][$key];
        $po['ani']=$_POST['ani'][$key];
        //顯示這個欄位是可勾可不勾的，性質跟del很像，所以把上面的copy下來
        //告訴他如果這個sh的陣列是存在的，表示有資料要設為顯示
        //而且要被設為顯示的這筆資料又剛好跟我現在輪到的這個id是一樣的
        //那就表示這筆資料要被設為顯示，不然他就是不顯示
        $po['sh']=(isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;

        $Poster->save($po);
    }
}

to("../back.php?do=poster");
<div>
    <h4 class='ct'>預告片清單</h4>
    <div style="display:flex;justify-content:space-between" class="ct">
        <div style="width:25%;background:#eee">預告片海報</div>
        <div style="width:25%;background:#eee">預告片片名</div>
        <div style="width:25%;background:#eee">預告片排序</div>
        <div style="width:25%;background:#eee">操作</div>
    </div>

    <form action="api/edit_poster.php" method="post">
        <div style="overflow:auto;height:200px">
            <?php
            // 我全部的資料=$Poster去撈出我全部的資料
            // 用rank這個值來做排序
            $rows = $Poster->all(" ORDER by `rank`");
            foreach ($rows as $row) {
                //我們要去告訴他有沒有哪個是被選擇的跟checkbox一樣，下拉選單的部分我們是用選擇
                //checkbox跟radio我們是用checked，選單用的是selected
                
                //顯示的話只有0跟1，所以我們可以在前面做好
                //如果$row的['sh']==1的話，我就顯示checked，不然我就顯示空字串
                //然後把$checked放到下方的顯示
                $checked=($row['sh']==1)?"checked":"";
                ?>
                <div style="display:flex" class="ct">
                    <div style="width:25%;">
                        <img src="img/<?= $row['path']; ?>" style="width:60px;">
                    </div>
                    <div style="width:25%;">
                        <input type="text" name="name[]" value="<?= $row['name']; ?>">
                    </div>
                    <div style="width:25%;"><?= $row['rank']; ?></div>
                    <div style="width:25%;">
                        <!-- 如果我是顯示的這邊就會打勾，如果我不是顯示的這邊就不會打勾 
                             因為這東西是在外部的，所以記得是< ?=$checked;?>，不要打成$checked
                            $checked代表我是在html寫php的變數，所以不會顯示出來
                            < ?=$checked;?>才是表示echo這個變數出來-->
                        <!-- 補充，這個選中的狀態，只要我有selected，他就會送值出去
                            但是顯示跟刪除，如果我有改變狀態的話，有被勾選的狀態才會送出值
                            但我要知道你勾選哪一個才能送出，所以我們還要在value的地方告訴他
                            請幫我把這筆資料的id帶進 -->
                        <!-- 另外，這項動作(放id)選單原則上不需要，因為選單你就算什麼都不選，
                            他也會送預設(第一個選項)的值出去,而sh跟del不一樣，他是有勾才會送
                            所以他送出來的陣列跟你的資料數會不一樣，而選單是假設今天有10筆資料，
                            你收到的ani就會有10筆，但sh跟dwl是有勾才會送出，所以如果你只有勾2個del的話
                            那個del的陣列就只會拿到2筆資料，他不是每筆都會送出來 -->
                        <input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=$checked;?>>顯示
                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
                        <!-- 用選單的方式選擇狀況 -->
                        <select name="ani[]">
                            <!-- checked只有0跟1，但這邊我們有3個選項，所以我這邊要判斷的是我是不是=1?
                            是不是=2?是不是=3?然後決定我要selected哪個東西，所以我要在這邊先打好
                            告訴他說我要看你的$row=多少，你的ani=多紹，來決定我這邊要不要出現selected
                            selected代表選中的狀況或者是空字串-->
                            <option value="1" <?=($row['ani']==1)?"selected":"";?>>淡入淡出</option>
                            <option value="2" <?=($row['ani']==2)?"selected":"";?>>縮放</option>
                            <option value="3" <?=($row['ani']==3)?"selected":"";?>>滑入滑出</option>
                        </select>
                        <!-- 我們要告訴他說，每一筆資料都要有對應的東西才方便我後面做 
                             告訴他有個叫id的陣列，然後value=我們剛才放的id
                             我們要有一個id的陣列去對應到我們的每一個值，要靠id陣列來處理才有辦法去對他做事情-->
                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="ct">
            <input type="submit" value="確定修改">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
<hr>
<div>
    <h4 class='ct'>新增預告片海報</h4>
    <!-- 要上傳檔案，所以要記得加multipart/form-data -->
    <form action="api/add_poster.php" method="post" enctype="multipart/form-data">
        <div class="ct">
            <label>
                預告片海報:
                <input type="file" name="path">
            </label>
            <label>
                預告片片名:
                <input type="text" name="name">
            </label>
        </div>
        <div class="ct">
            <input type="submit" value="新增">
            <input type="reset" value="重置">
        </div>
    </form>
</div>
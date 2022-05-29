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
            foreach ($rows as $key => $row) {
                //我們要去告訴他有沒有哪個是被選擇的跟checkbox一樣，下拉選單的部分我們是用選擇
                //checkbox跟radio我們是用checked，選單用的是selected
                
                //顯示的話只有0跟1，所以我們可以在前面做好
                //如果$row的['sh']==1的話，我就顯示checked，不然我就顯示空字串
                //然後把$checked放到下方的顯示
                $checked=($row['sh']==1)?"checked":"";
                    // 陣列的第一筆資料使用...判斷，但這邊沒有key值所以我們自己加上去
                    // 我要判斷他是不是第一筆的重點就來自於這個key值

                    // $key==0表示是第一筆
                    if($key==0){    
                        //如果他是第一欄的話，跟自己的id(值)交換(不會有排序的問題)
                        $up=$row['id'] . "-" . $row['id'];
                        //往下
                        //現在的情況像是大家本來按照座號做，但後來序號被打亂全部人亂坐，但我們還是想知道左右邊是坐誰
                        //不可以寫$row['id']+1，這樣代表當前rank排序1的第一筆資料的id直接+1 ，這樣會因撞id出錯
                        //第一個的索引值+1
                        //rows是一個二微陣列，我現在在的這筆資料是每一筆都會回圈一次然後把資料給$row這個變數
                        //所以我不管在何時，我所輪到的那筆資料都是$rows[$key]的這筆資料，我的迴圈的每一筆的值都是$rows[$key]這筆資料
                        //我現在迴圈到的這個row 我要他的下一筆就是我的$rows現在輪到的這筆資料[$key(索引值) 要+1 ]，知道下一筆後我要的是他的['id']
                        $down=$row['id'] . "-" . $rows[$key+1]['id'];
                    }
                    
                    //最後一筆，找索引值的最大值
                    //陣列長度-1就是索引值，我們知道陣列的索引值是從0開始的
                    //比如有1,2,3,4,5個東西，但索引值會是0,1,2,3,4
                    //所以最大的索引值會跟陣列個數差1，而長度-1就能找到最大索引值

                    //如果我的key值=長度(陣列長度在php用count函式)，count我的$rows這個陣列裡面的值的個數 -1就會拿到值
                    //php array index max  查到的max(array_keys($arr)); 也可以
                    if($key==(count($rows)-1)){
                        //往下，跟自己交換
                        $down=$row['id'] . "-" . $row['id'];
                        // 我的上一筆是我的$key-1,注意如果只有一筆資料的話這個程式會出錯
                        // 這個方法來說要有2筆資料，不然往上跟往下的功能都會出錯，3筆的話這個功能才會正常
                        // 實務上如果遇到只有一筆資料卻要往上往下的功能的話,就要加判斷我到底有沒有上一筆/下一筆
                        $up=$row['id'] . "-" . $rows[$key-1]['id'];
                    }

                    //中間一筆
                    if($key>0 && $key<(count($rows)-1)){
                        $up=$row['id'] . "-" . $rows[$key-1]['id'];
                        //變數記得改成$rows
                        $down=$row['id'] . "-" . $rows[$key+1]['id'];
                    }


                ?>
                <div style="display:flex" class="ct">
                    <div style="width:25%;">
                        <img src="img/<?= $row['path']; ?>" style="width:60px;">
                    </div>
                    <div style="width:25%;">
                        <input type="text" name="name[]" value="<?= $row['name']; ?>">
                    </div>
                    <div style="width:25%;"> 
                        <!-- 用input 的方式告訴他type是button 
                            按下去的時候要跟誰做交換 data-sw控制-->
                        <!-- 取得我點下的按鈕 -->
                    <input type="button" class="sw" value="往上" data-sw="<?=$up;?>">
                    <input type="button" class="sw" value="往下" data-sw="<?=$down;?>">
                    </div>
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


<script>
    //兩個id做交換
    //想要兩個變數交換的話，要多一個暫存用的變數，再把值做交換
    //當我的sw被點的時候
    $('.sw').on('click',function(){
        
        //用explode再加上- 就可以把字串拆成陣列，陣列裡面就是我-的前後兩個單位
        //像是用explode拆檔案的副檔名 檔案.副檔名 這樣
        //或是用explode拆日期 用/把日期拆成年月日，然後ˇ放在陣列裡面的這三個位置
        
        //$(this) 我點下去的這個事件它裡面會有一個.data("sw")
        //js中分割字串 split
        // let id=$(this).data("sw");
        // console.log(id);
        let id=$(this).data("sw").split("-");
        // console.log(id);

        // 考慮到院線片也會用到這個交換功能，而我們撈出資料就需要知道他是哪張資料表
        // 如果這邊寫死的話，院線片那邊就要再寫一個switch很麻煩，所以前端除了送出id外還要再送出一個table
        // 告訴我你是哪一張table的id要做交換，這邊就是poster這張資料表要做交換
        //做完之後重整 reload=當前頁重整
         $.post("api/sw.php",{id,table:"level3_poster"},()=>{
            location.reload();
        })
    })

</script>
<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<!-- 記得用滾軸overflow -->
<div style="overflow:auto;height:420px;">
    <?php
    //用rank這個欄位做排序
    $mos = $Movie->all(" ORDER BY rank");
    // 把東西撈出來
    foreach ($mos as $key => $movie) {

        // 複製來自back/poster.php
        // $row改成$movie，$rows改成$mos


        if ($key == 0) {
            $up = $movie['id'] . "-" . $movie['id'];
            $down = $movie['id'] . "-" . $mos[$key + 1]['id'];
        }

    
        if ($key == (count($mos) - 1)) {
            $down = $movie['id'] . "-" . $movie['id'];
            $up = $movie['id'] . "-" . $mos[$key - 1]['id'];
        }

        //中間一筆
        if ($key > 0 && $key < (count($mos) - 1)) {
            $up = $movie['id'] . "-" . $mos[$key - 1]['id'];
            $down = $movie['id'] . "-" . $mos[$key + 1]['id'];
        }


    ?>


        <div style="display:flex;width:100%;">
            <div style="width:10%">
                <img src="img/<?= $movie['poster']; ?>" style="width:100%">
            </div>
            <div style="width:10%">
                分級:
                <img src="icon/<?= $movie['level']; ?>.png">
            </div>
            <div style="width:80%">
                <div style="display:flex">
                    <div style="width:33%">片名:<?= $movie['name']; ?></div>
                    <div style="width:33%">片長:<?= $movie['length']; ?></div>
                    <div style="width:33%">上映時間:<?= $movie['ondate']; ?></div>
                </div>
                <div style="text-align:right">
                    <!-- 要告訴他是哪筆資料，所以先跟他說data-id= $movie['id']
                        class=show(也可以不取show取別的，隨便你)
                    -->
                    <button class="show" data-id="<?= $movie['id']; ?>">
                        <!-- 當$movie['sh']==1時顯示，不是就隱藏 -->
                        <?= ($movie['sh'] == 1) ? "顯示" : "隱藏"; ?>
                    </button>
                    <button class="sw" data-sw="<?=$up;?>">往上</button>
                    <button class="sw" data-sw="<?=$down?>">往下</button>
                    <!--修改跟新增很像，差別在於修改時要跟他說你要修改的是哪部電影
                        所以複製最上面的新增電影改成修改再告訴他id-->
                    <button onclick="location.href='?do=edit_movie&id=<?= $movie['id']; ?>'">編輯電影</button>
                    <!-- 請你去刪除某張table的某個id的資料 
                         我會去告訴你哪個table哪個id的訊息，你就去刪了它
                         'movie'就是table名稱，id就是$movie['id']
                          function雖然也可以寫在下面，但因為別的地方也會用到，所以寫在外部比較好-->
                    <button onclick="del('level3_movie',<?= $movie['id']; ?>)">刪除電影</button>
                </div>
                <div>
                    劇情介紹：<?= $movie['intro']; ?>
                </div>
            </div>
        </div>
        <hr>
    <?php
    }
    ?>

</div>

<script>
// 往上往下的事件，複製自back/poster
// table記得要改
    $('.sw').on('click',function(){
        let id=$(this).data("sw").split("-");
        // console.log(id);

        // 考慮到院線片也會用到這個交換功能，而我們撈出資料就需要知道他是哪張資料表
        // 如果這邊寫死的話，院線片那邊就要再寫一個switch很麻煩，所以前端除了送出id外還要再送出一個table
        // 告訴我你是哪一張table的id要做交換，這邊就是poster這張資料表要做交換
        //做完之後重整 reload=當前頁重整
         $.post("api/sw.php",{id,table:"level3_movie"},()=>{
            location.reload();
        })
    })








    // 回乎函式不管是用function()還是箭頭函式
    // ()裡面都可以帶入e或是event，隨便你取都可以
    // cosole.log(e)可以看到很多東西
    //cosole.log(e.target)可以看到你點下的東西
    $(".show").on("click", function(e) {

        let id = $(e.target).data("id");
        $.post("api/show.php", {
            id
        }, () => {
            location.reload();
        })
    })

    /* 

    //如果想要箭頭函示比較潮，可以用這種箭頭函式
    //不用的話就用$thisO(原本的寫法)

    // 這個寫法跟下面不同的是它是沒有使用this去抓到要的東西
    // $this在長久的js運作有時會出問題，所以盡量避免
    // 所以事件型的回乎函式都可以拿它來用
        $(".show").on("click",(e)=>{
        let id=$(e.target).data("id");
        $.post("api/show.php",{id},()=>{
            location.reload();
        })
    }) */


    // 原本的寫法
    // 當show被點下去的時候，我會拿到我的id
    // $(".show").on("click",function(){
    // let id=$(this).data("id");
    // 我哪一筆資料要顯示隱藏就把這個資料丟到後台去
    // 因為只有這個地方要用到所以可以不用加table，只帶id過去就好了
    //     $.post("api/show.php",{id},()=>{
    //         location.reload();
    //     })
    // })
</script>
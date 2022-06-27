<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<!-- 記得用滾軸overflow -->
<div style="overflow:auto;height:420px;">
    <?php
    //用rank這個欄位做排序
    $mos = $Movie->all(" ORDER BY rank");
    // 把東西撈出來
    foreach ($mos as $key => $movie) {
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
                    <button class="show" data-id="<?=$movie['id'];?>">
                    <!-- 當$movie['sh']==1時顯示，不是就隱藏 -->
                    <?=($movie['sh']==1)?"顯示":"隱藏";?>
                    </button>
                    <button>往上</button>
                    <button>往下</button>
                    <!--修改跟新增很像，差別在於修改時要跟他說你要修改的是哪部電影
                        所以複製最上面的新增電影改成修改再告訴他id-->
                    <button onclick="location.href='?do=edit_movie&id=<?=$movie['id'];?>'">編輯電影</button>
                    <!-- 請你去刪除某張table的某個id的資料 
                         我會去告訴你哪個table哪個id的訊息，你就去刪了它
                         'movie'就是table名稱，id就是$movie['id']
                          function雖然也可以寫在下面，但因為別的地方也會用到，所以寫在外部比較好-->
                    <button onclick="del('level3_movie',<?=$movie['id'];?>)">刪除電影</button>
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
// 當show被點下去的時候，我會拿到我的id
$(".show").on("click",function(){
    let id=$(this).data("id");
    // 我哪一筆資料要顯示隱藏就把這個資料丟到後台去
    //因為只有這個地方要用到所以可以不用加table，只帶id過去就好了
    $.post("api/show.php",{id},()=>{
        location.reload();
    })
})

</script>
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
                    <button>顯示</button>
                    <button>往上</button>
                    <button>往下</button>
                    <button>編輯電影</button>
                    <button>刪除電影</button>

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
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
                        <input type="checkbox" name="sh[]" value="">顯示
                        <input type="checkbox" name="del[]" value="">刪除
                        <!-- 用選單的方式選擇狀況 -->
                        <select name="ani[]">
                            <option value="1">淡入淡出</option>
                            <option value="2">縮放</option>
                            <option value="3">滑入滑出</option>
                        </select>
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
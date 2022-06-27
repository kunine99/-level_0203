<?php
//複製add_movie.php再來改
//我這筆$movie=$Movie去find找到我用get傳過來的id就會拿到這筆movie的資料了
//然後片名那邊就用value寫入
$movie=$Movie->find($_GET['id']);
?>
<!-- 新增改成編輯 -->
<h3 class='ct'>編輯院線片</h3>
<!-- 我要上傳檔案，有預告片跟電影海報要做，所以要加multipart/form-data -->
<form action="api/edit_movie.php" method="post" enctype="multipart/form-data">
    <div style="display:flex">
        <div style="width:15%">影片資料</div>
        <div style="width:85%">
            <div>
                <label>片名:</label>
                <!-- 寫入value -->
                <input type="text" name="name" value="<?=$movie['name'];?>">
            </div>
            <div>
                <label>分級:</label>
                <select name="level" >
                    <option value="1">普遍級</option>
                    <option value="2">輔導級</option>
                    <option value="3">保護級</option>
                    <option value="4">限制級</option>
                </select>(請選擇分級)
            </div>
            <div>
                <label>片長:</label>
                <!-- 寫入value -->
                <input type="number" name="length" value="<?=$movie['length'];?>">
            </div>
            <div>
                <label>上映日期:</label>
                <select name="year">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>年
                <select name="month">
                <?php
                    for($i=1;$i<=12;$i++){
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>月
                <select name="day">
                    <?php
                    for($i=1;$i<=31;$i++){
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>日
            </div>
            <div>
                <label>發行商:</label>
                <!-- 寫入value -->
                <input type="text" name="publish" value="<?=$movie['publish'];?>">
            </div>
            <div>
                <label>導演:</label>
                <!-- 寫入value -->
                <input type="text" name="director" value="<?=$movie['director'];?>">
            </div>
            <div>
                <label>預告影片:</label>
                <input type="file" name="trailer">
            </div>
            <div>
                <label>電影海報:</label>
                <input type="file" name="poster">
            </div>
        </div>
    </div>
    <div style="display:flex">
        <div style="width:15%">劇情簡介</div>
        <div style="width:85%">
            <!-- 寫入value -->
            <textarea name="intro" style="width:99%"><?=$movie['intro'];?></textarea>
        </div>
    </div>
    <div class="ct">
        <!-- 送出去後要告訴後台我是哪筆資料做修改，所以要有一個欄位方ID的資料
             所以放隱藏欄位，這個name="id"不用放陣列因為它只有一筆資料而已-->
        <input type="hidden" name="id"  value="<?=$movie['id'];?>">
        <!-- 新增改成修改 -->
        <input type="submit" value="修改">
        <input type="reset" value="重置">
    </div>
    <!-- 如果懶的加edit_movie，要用跟add_movie同個api的話
    $_POST['rank']排序記得要修改，免得修改後又被一起改掉了-->
</form>
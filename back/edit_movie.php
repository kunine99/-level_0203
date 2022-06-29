<?php
//複製add_movie.php再來改
//我這筆$movie=$Movie去find找到我用get傳過來的id就會拿到這筆movie的資料了
//然後片名那邊就用value寫入
$movie = $Movie->find($_GET['id']);
//用年月日算選單的日期,有兩個做法1.拆字串的方式 2.函數轉換用strtotime去轉換
//我們抓出來的月份有可能是單位數或是雙位數,我們需要它統一
//而我們下面是從1開始(不是01開始),如果用字串的方式可能會抓到01、02、03這樣會對不起來
//所以我們用轉換數列的方式(搜尋php date),用n可以以沒有前導零的方式顯示1~12月
//j也可以以沒有前導零的方式顯示1~30日
//date(j、n,這邊要放秒數所以用strtotime把$movie['ondate']轉成秒數)
$day = date("j", strtotime($movie['ondate']));
$month = date("n", strtotime($movie['ondate']));
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
                <input type="text" name="name" value="<?= $movie['name']; ?>">
            </div>
            <div>
                <label>分級:</label>
                <select name="level">
                    <option value="1">普遍級</option>
                    <option value="2">輔導級</option>
                    <option value="3">保護級</option>
                    <option value="4">限制級</option>
                </select>(請選擇分級)
            </div>
            <div>
                <label>片長:</label>
                <!-- 寫入value -->
                <input type="number" name="length" value="<?= $movie['length']; ?>">
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
                    for ($i = 1; $i <= 12; $i++) {
                        //在這邊做$selected這個字串的編輯
                        //如果我的$i==我的$month的話我就呈現一個叫selected不然就顯示空字串
                        $selected = ($i == $month) ? "selected" : "";
                        //當我在顯示表單的時候,我要在這個地方去判斷我當下要選的是哪個
                        //然後把這個選單接在後面$selected的這個字串
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>月
                <select name="day">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        //這邊變數雖然跟上面一樣,不過沒有關係
                        //因為用過一次之後在往下走在用它然後就沒有了
                        //變數可以重複用
                        $selected=($i==$day)?"selected":"";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>日
            </div>
            <div>
                <label>發行商:</label>
                <!-- 寫入value -->
                <input type="text" name="publish" value="<?= $movie['publish']; ?>">
            </div>
            <div>
                <label>導演:</label>
                <!-- 寫入value -->
                <input type="text" name="director" value="<?= $movie['director']; ?>">
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
            <textarea name="intro" style="width:99%"><?= $movie['intro']; ?></textarea>
        </div>
    </div>
    <div class="ct">
        <!-- 送出去後要告訴後台我是哪筆資料做修改，所以要有一個欄位方ID的資料
             所以放隱藏欄位，這個name="id"不用放陣列因為它只有一筆資料而已-->
        <input type="hidden" name="id" value="<?= $movie['id']; ?>">
        <!-- 新增改成修改 -->
        <input type="submit" value="修改">
        <input type="reset" value="重置">
    </div>
    <!-- 如果懶的加edit_movie，要用跟add_movie同個api的話
    $_POST['rank']排序記得要修改，免得修改後又被一起改掉了-->
</form>
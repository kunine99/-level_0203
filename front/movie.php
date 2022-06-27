<style>
/* 作用範圍為.movie-list以下的所有東西(包括.movie-list) */
.movie-list *{
    /* box-sizing會把所有元素的寬度不是用內容在算的，而是用整體在算的
       這樣border的東西才會被送到整體寬度裡面去，如果想解決border多出上下1px(總共2px)的問題
       就要把這個元素border加到box-sizing裡面去，這樣我在算元素跟元素之間的寬度時才比較好算*/
    box-sizing:border-box;
}

.movie-list{
    /* flex的特性是
        1.它是橫列屬性的東西，只要在一個div下display:flex的話，它會把所有第一層的子元素放在同一個橫列上面 
        2.他會根據他自己的寬度，盡可能把所有子元素都塞在這個寬度裡面
        所以需要換行的話，就還要再加東西(像是flex-wrap:wrap;)*/
    display:flex;
    flex-wrap:wrap;
}

/* 作用範圍為.movie-list下面的第一層div而已 */
.movie-list > div{
    width:49%;
    margin:0.5%;
    border:1px solid white;
    border-radius:8px;
}
</style>
<div class="half">
    <h1>院線片清單</h1>
    <!-- 這邊不管是用trtd或是table都很麻煩，所以最後用div -->
    <div class="rb tab" style="width:95%;">
        <div class="movie-list">
        <?php
            $today=date("Y-m-d");
            // 開始的時間是今天減兩天
            $ondate=date("Y-m-d",strtotime("-2 days"));
            //分頁

            //這樣寫也可以，但容易寫錯
            // $rows=$Movie->all(" where `sh`=1 && `ondate` <= '".date("Y-m-d")."' && `ondate` >= '".date("Y-m-d",strtotime("-2 days"))."' Order By `rank`");

            // sql語法 between 第一個值一定要比較小，第2個要比較大

            //我要找出很多筆資料，這邊直接寫句子的語法來使用，貼在select * form table後面，用字串的方式來處理
            //當我的顯示的欄位是1的時候，而且我的上印日期在兩天前到今天之間，這三天的時間的電影用rank來排序
            $rows=$Movie->all(" where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today' Order By `rank`");

            foreach($rows as $key => $row){
        ?>
            <div>
                <div>片名:<?=$row['name'];?></div>
                <div style="display:flex">
                    <div>
                        <img src="img/sdfsafd.png" style="width:60px">
                    </div>
                    <div>
                        <div>分級:</div>
                        <div>上映日期:</div>
                    </div>
                </div>
                <div>
                    <button>電影簡介</button>
                    <button>線上訂票</button>
                </div>
            </div>
        <?php
        }
        ?>
        </div>

        <div class="ct">< 1 2 3 ></div>
    </div>
</div>
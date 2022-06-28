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
            
            // 要記數所以用count,記數的欄位是全部*，條件不需要Order By我只是要計算總數,所以只要知道哪些資料要撈出來排序就好
            $all=$Movie->math('count','*'," where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today'");
            $div=4; //每一頁四筆
            // 拿到這兩個數字後就可以來算總頁數了
            $pages=ceil($all/$div); //總頁數 ceil取天花板($all)和$div
            //從第一頁開始算,然後看我有沒有帶$_GET的這個變數,如果有p這個變數的話就是當前頁,沒有的話就在第一頁
            $now=$_GET['p']??1; //我現在的頁數 三元運算式縮寫法
            //從我現在的頁數-1去*$div,-1是因為資料是從零開始算的
            //-1之後如果在第一頁的話就是從0筆開始算4筆就是 0 1 2 3
            $start=($now-1)*$div; //我開始的筆數 
            //把資料帶進來,Order By完之後我告訴他，
            //在你前面的條件完成之後我只取$start開始的索引值一直到$div的筆數的資料才是我要的
            $rows=$Movie->all(" where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today' 
                                Order By `rank` 
                                limit $start,$div");



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

        <div class="ct"  >
            <!-- 分頁，我要秀箭頭符號跟數字 -->
            <?php
            //如果我的當前頁-1>0 表示我有上一頁
            if(($now-1)>=1){
                // $prev 我的上一頁=$now-1
                $prev=$now-1;
                echo "<a href='index.php?p=$prev'  style='color:white'> ";
                echo " < ";
                echo " </a>";
            }

            // 1 2 3 4用for迴圈來做,從第一頁開始算
            // $i會<=我的總頁數
            for($i=1;$i<=$pages;$i++){
                // 當前頁放大，是不是跟我的迴圈在跑的當前頁一樣,是的話24px 不是的話16px
                $size=($now==$i)?"24px":"16px"; 
                echo "<a href='index.php?p=$i' style='font-size:$size'> ";
                //當前頁的內容
                echo $i;
                echo " </a>";
            }

            // 我現在的頁面+1，然後它不能夠超過我的總頁數(最多只能=我的總頁數)
            if(($now+1)<=$pages){
                // $next 我的下一頁=$now-1
                $next=$now+1;
                echo "<a href='index.php?p=$next'  style='color:white' > ";
                echo " > ";
                echo " </a>";
            }


            ?>

        </div>
    </div>
</div>
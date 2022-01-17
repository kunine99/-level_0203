<style>
    .movie-list * {
        box-sizing: border-box;
    }

    .movie-list {
        display: flex;
        flex-wrap: wrap;
    }

    /* ~ 兄弟層  */
    .movie-list>div {
        width: 49%;
        margin: 0.5%;
        border: 1px solid white;
        border-radius: 8px;
    }
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="movie-list">
            <?php
            $today = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));
            //分頁
            $all=$Movie->math('count','*'," where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today'");
            $div=4;
            $pages=ceil($all/$div);
            $now=$_GET['p']??1;
            $start=($now-1)*$div;
            $rows=$Movie->all(" where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today' 
                                Order By `rank` 
                                limit $start,$div");

            /* between 0(比較小的參數) and  0(比較大的參數) */
            // $rows = $Movie->all(" where `sh`=1 && `ondate` BETWEEN '$ondate' AND '$today' Order By `rank`");
            foreach ($rows as $key => $row) {
            ?>
                <div>
                    <div>片名:<?= $row['name']; ?></div>
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
        <div class="ct">
            <?php
            if(($now-1)>=1){
                $prev=$now-1;
                echo "<a href='index.php?p=$prev'> ";
                echo " < ";
                echo " </a>";
            }

            for($i=1;$i<=$pages;$i++){
                $size=($now==$i)?"24px":"16px";
                echo "<a href='index.php?p=$i' style='font-size:$size'> ";
                echo $i;
                echo " </a>";
            }

            if(($now+1)<=$pages){
                $next=$now+1;
                echo "<a href='index.php?p=$next' > ";
                echo " > ";
                echo " </a>";
            }


            ?>
        </div>
    </div>
</div>
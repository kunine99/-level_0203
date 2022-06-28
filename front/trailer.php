<style>
    /* 下面的所有標籤 */
    /* 兩個不同的選擇器共用的box-sizing: border-box */
    .lists *,
    .controls * {
        box-sizing: border-box;
    }

    .lists {
        width: 210px;
        height: 260px;
        margin: auto;
        /* 控制溢出的屬性overflow ，如果是auto就會有滾動軸 */
        overflow: hidden;
    }

    .lists .po {
        width: 100%;
        text-align: center;
        /* 先只讓第一張秀出來，所以display: none; */
        display: none;
    }

    .po img {
        width: 100%;
        border: 2px solid white;
    }

    .controls {
        display: flex;
        margin: auto;
        width: 100%;
        align-items: center;
        /* justify-content: space-around; 每一個元件的周邊(上下左右?)都有空白 */
        /* justify-content: space-between; 元件的中間有空白 */
        justify-content: space-evenly;
    }

    .icons {
        display: flex;
        width: 320px;
        height: 90px;
    }

    .icon {
        width: 80px;
        height: 20px;
    }

    .left {
        /* 把不必要的顏色都加transparent */
        border-top: 20px solid transparent;
        border-right: 25px solid black;
        border-bottom: 20px solid transparent;
        /* border-left:25px solid  transparent; */
        cursor: pointer;
    }

    .right {
        border-top: 20px solid transparent;
        /* border-right:25px solid transparent; */
        border-bottom: 20px solid transparent;
        border-left: 25px solid black;
        cursor: pointer;
    }

    .left:hover {
        border-right: 25px solid #555;
    }

    .right:hover {
        border-left: 25px solid #555;
    }
</style>

<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div>
            <div class="lists">
                <?php
                // 秀出所有的海報 
                //條件是 `sh`=1 排序依據  `rank`
                $pos = $Poster->all(" where `sh`=1 Order By `rank`");
                foreach ($pos as $key => $po) {
                    echo "<div class='po'>";
                    echo "<img src='img/{$po['path']}'>";
                    echo $po['name']; //預告片名稱

                    echo "</div>";
                }

                ?>
            </div>

            <div class="controls">
                <div class="left"></div>
                <div class="icons">
                    <div class="icon">sss</div>
                    <div class="icon">sss</div>
                    <div class="icon">sss</div>
                    <div class="icon">sss</div>
                </div>
                <div class="right"></div>
            </div>
        </div>
    </div>
</div>
<script>
    //寫在dom下面，也就是說要這個dom顯示完之後,請幫我執行script
    //請讓一系列裡面的po裡的第一個(0)，顯示出來
    // eq 指定 =誰的意思，這邊就是說整個po裡面第幾個要顯示出來
    $(".po").eq(0).show();
</script>
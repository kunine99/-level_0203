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
        /* 為了讓動畫在一個精準的位置上設position
        position: absolute;比較精準(會去找我上面的東西)
        設position: relative;讓它集中在一個位置上
        */
        position: relative;
    }

    .lists .po {
        width: 100%;
        text-align: center;
        /* 先只讓第一張秀出來，所以display: none; */
        display: none;
        position: absolute;
    }

    .po img,
    .icon img {
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
        height: 110px;
        overflow: hidden;
        font-size: 12px;
    }

    .icon {
        width: 80px;
        flex-shrink: 0;
        padding: 5px;
        position: relative; 
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
                    // 綁個ani給他,這樣我才會知道輪到你的時候你要的動畫是什麼
                    echo "<div class='po' data-ani='{$po['ani']}'>";
                    echo "<img src='img/{$po['path']}'>";
                    echo $po['name']; //預告片名稱

                    echo "</div>";
                }

                ?>
            </div>

            <div class="controls">
                <div class="left"></div>
                <div class="icons">
                    <?php
                    //直接複製上面的秀出所有的海報
                    foreach ($pos as $key => $po) {
                        echo "<div class='icon' data-ani='{$po['ani']}'>";
                        echo "<img src='img/{$po['path']}'>";
                        echo $po['name'];
                        echo "</div>";
                    }
                    ?>
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

    let i = 0; 
    //為了告訴它有多少個(避免超過),所以設all告訴他總共有幾張海報
    let all = $('.po').length; 

    // 通常我們在做setInterval時我們會習慣在前面放個變數
    // setInterval會帶入兩個參數,一個是你要執行的程式(用回乎函式來做) 一個是間格多久一次
    // 每隔2.5秒去執行這個程式一次
    let slides = setInterval(() => {
        // 請去找到現在在顯示的圖片,然後分別讓他們隱藏顯示隱藏顯示
        // 為了達到這個目的,我要知道現在輪到誰,於是設i變數從零開始
        i++;
        //如果i++ 的數字大於all(海報總數),就設i為0
        //比如如果現在有7張海報01234567,7-1=6,那我就把i變成0,表示下一張是從0開始
        if (i > all - 1) {
            i = 0;
        }

        // 你要在這邊(前面那個i++然後if那段)幫我決定下一張是誰(下一張就是現在這張+1)
        // 之後請他去執行ani然後把它帶進去,這就是我的ani
        ani(i);

    }, 2500);

    // 為了要知道我下一張圖片是什麼寫個function
    // ani的n代表下一張圖片
    function ani(n) {
        // i進來後就可以知道下一張是誰
        // 下一張的這個i值,就可以拿到標籤裡面的data('ani')的值
        // 拿到值要給它個變數,這樣它才能做切換
        let ani = $(".po").eq(n).data('ani');
        let now = $(".po:visible") //visible可以幫我抓到當下display:block的元素是哪一個
        //上面有解決最後一張的問題所以這邊可以直接寫eq(n)(如果上面沒有檔這邊就要特別注意!!!!!!!!!!!!!!!!!!!!這點很重要,因為)
        let next = $(".po").eq(n)

        // 如果要做轉場動畫的話,我要做的是淡入淡出還是縮放呢?都可以
        // 因為我們想要讓動畫完整點(淡入完才淡出,不要同時進行)
        // 那首先要注意的是別讓動畫間格太緊(比如淡入淡出共2000，那執行程式時就設2500)
        // 以後如果有問題只要改上面就好,switch這邊都不用動了
        switch (ani) {
            case 1:
                //淡入淡出
                now.fadeOut(1000);
                next.fadeIn(1000);
                break;
            case 2:
                //縮放
                now.hide(1000, function() {
                    next.show(1000);
                });
                break;
            case 3:
                //滑入滑出,用回乎函式感覺比較好看一點
                now.slideUp(1000, function() {
                    next.slideDown(1000);
                });
                break;
        }
    }

    let p = 0; //從0開始算頁數,最多可以點幾下
    // 當我去點擊left跟right的時候,會產生一個function
    // 為了要判斷我點的是左邊還是右邊,我們利用class的名稱
    $(".left,.right").on("click", function() {
        // 如果它有class叫做left就是左邊(上一頁)
        if ($(this).hasClass('left')) {
            // 如果p-1>0 表示我還有上一個圖片可以顯示
            if (p - 1 >= 0) {
                p--;
            }
        // 沒有class就是右邊(下一頁)
        } else {
        // 如果p+1 < 總數
            if (p + 1 <= all - 4) {
                p++;
            }
        }
        //上面這樣就決定好我的位移量了,接下來要決定每位移一個要從r那邊+80px過來
        //我的icon都做全部的事情,animate兩個參數,
        //第一個參數接我css屬性,第2個時間, 第3個回乎函式先不理它
        //在一秒的時間幫某個東西位移80的量
        $(".icon").animate({
            right: p * 80
        }, 500)
    })
</script>
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
        background: white;
    }

    .controls {
        display: flex;
        margin: auto;
        width: 380px;
        /* 垂直置中 */
        align-items: center;
    }

    .icons {
        display: flex;
        width: 320px;
        background: pink;
        height: 90px;
    }

    .icon {
        width: 80px;
        height: 20px;
        background: green;
    }

    .left {
        width: 30px;
    }

    .right {
        width: 30px;
    }
</style>

<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div>
            <!-- 預告片海報列表 -->
            <div class="lists">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <!-- 控制按鈕 -->
            <div class="controls">
                <div class="left">左</div>
                <div class="icons">
                    <div class="icon">sss</div>
                    <div class="icon">sss</div>
                    <div class="icon">sss</div>
                    <div class="icon">sss</div>
                </div>
                <div class="right">右</div>
            </div>
        </div>
    </div>
</div>
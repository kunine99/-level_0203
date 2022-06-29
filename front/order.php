<!-- 連動式選單 -->
<h3 class='ct'>線上訂票</h3>
<style>
    #order{
        width:50%;
        margin:auto;
    }
    .row{
        display:flex;
        width:100%;
    }
    /* 子選擇器 這樣寫也可以.row div:first-child
       .row下面的div的第一個 */
    .row .first{
        width:15%;
        text-align:right;
    }
    /* 子選擇器 這樣寫也可以.row div:nth-child(2)*/
    .row .sec{
        width:85%;
        text-align:left;
    }
    /* 子選擇器 這樣寫也可以.row:nth-last-child(0) div ???*/
    .sec select{
        width:100%;
    }

</style>
<div id="order">
    <!-- div.row*4>div+div>select -->
<div class="row">
    <div class="first">電影：</div>
    <!-- 要用ajax的作法m所以input這邊都要記得加上id -->
    <div class="sec"><select name="movie" id="movie"></select></div>
</div>
<div class="row">
    <div class="first">日期：</div>
    <div class="sec"><select name="date" id="date"></select></div>
</div>
<div class="row">
    <div class="first">場次：</div>
    <div class="sec"><select name="session" id="session"></select></div>
</div>
<div class="row">
    <div class="ct" style="width:100%">
        <button>確定</button><button>重置</button>
    </div>
    
</div>
</div>
<script>
    //應該要有一個程式(=api)讓我可以拿到電影的東西,要帶什麼參數去呢?
    //原則上是不需要帶參數,我現在只是想把我所有可以訂的電影的票.....?
    //他會回傳我電影的列表(movies)回傳之後我就把它放到我的畫面上
    $.get("api/get_movies.php",(movies)=>{
    // 當我的畫面載入的時候,就去我的#movie放入movies
    $("#movie").html(movies)
})
</script>
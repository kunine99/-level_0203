<!-- 訂票 -->
<style>
    #order{
        width:50%;
        margin:auto;
    }
    .row{
        display:flex;
        width:100%;
    }
    /* .row 下面的div從前面數來的第一個? */   
    .row .first{
        width:15%;
        text-align:right;
    }
    .row .sec{
        width:85%;
        text-align:left;
    }
    .sec select{
        width:100%;
    }
    </style>
<div id="order">
    <div class="row">
        <div class="first">電影：</div>
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
    // ajax 後端要有個api 前端要有ajs?
    $.get("api/get_movies.php",(movies)=>{
        $("#movie").html(movies)
    })
    </script>
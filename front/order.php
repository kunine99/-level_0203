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
let id=(new URL(location)).searchParams.get('id');
getMovies(id)

    // js裡小括號()包起來的東西基本上都會當成是一個程式，然後傳出去的會回傳給小括號...?
function getMovies(id){

    // ajax 後端要有個api 前端要有ajs?
    // $.get("api/get_movies.php",(movies)=>{
    //     $("#movie").html(movies)
    // })


$("#movie").on("change",()=>{getDays()})
function getMovies(id){
    $.get("api/get_movies.php",{id},(movies)=>{
        $("#movie").html(movies)
        getDays()
    })
}
function getDays(){
    let id=$("#movie").val();
    $.get("api/get_days.php",{id},(days)=>{
        $("#date").html(days)
    })
}
}



// 這邊可以不用帶參數，因為裡面的東西是根據我選擇的狀況


    </script>
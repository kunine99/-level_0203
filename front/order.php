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
    // $.get("api/get_movies.php",(movies)=>{
    // 當我的畫面載入的時候,就去我的#movie放入movies
    // $("#movie").html(movies)})
    


    //多種狀態要重複執行的時候,盡量把這個單一功能的程式function化
    //這樣我們才能在不同的情境下呼叫它
    //這邊盡量用純前端的方式做
    //web api url 你把一個網址丟進來,它就會幫你拆解成很多屬性
    // 把一整串new URL(location)的東西用小誇號()包起來,在js裡小誇號包起來的東西基本上都會被當成一個程式馬上執行,
    // 而且會回傳結果到這個小誇號,你可以當成它是一個變數,
    // searchParams就會找到你網址的id(自己理解)
    let id=(new URL(location)).searchParams.get('id'); //這個分號在後端很重要,如果沒有它,網頁就會把他跟下一行的getMovies(id)算成同一行,de bug會de到掛
    getMovies(id)
    //觸發事件,當我的#movie發生改變的時候請去幫我執行getDays的程式
    $("#movie").on("change",()=>{getDays()})

    // 我要用帶值的方式
    // 帶一個id值進來,他決定了我的選單要選在什麼地方
    // 當id是0的時候呢,我就告訴他你就回復全部的選項
    // 如果id有特定在某個值的話,那那個值的電影要幫我呈現選中的狀況
    // 那這個id要怎麼來呢?id可以選在function內,不過我麼這邊選擇寫在參數裡面
    function getMovies(id){
        $.get("api/get_movies.php",{id},(movies)=>{
        $("#movie").html(movies)
        //如果這邊沒有放getDays()的話,我剛進來時就會沒有(我載入畫面他有拿到電影名稱,但他沒有拿到日期)
        //這邊是連動式選單的重點,我要考慮在各種狀況下這個選單的變化跟他連動要帶動的情他選單的變化是什麼
        //為了解決這問題,我們就要在程式剛載入getMovies完的時候(產生完選單的時候)
        //讓他去執行getDays的動作
        //所以我改變的時候做一次,載入的時候做一次
        getDays()
    })
}

    // 拿日期,這邊可以不用帶參數,因為我的參數都來自於我選擇的狀況
    function getDays(){
        //let id=我的#movie現在選到的東西
    let id=$("#movie").val();
    //把它丟到丟到後台去請他去找一個api/get_days.php的程式,
    //然後把id帶過去,我會拿到days的結果
    $.get("api/get_days.php",{id},(days)=>{
        // 然後把days結果放到我的#date的那個選單(項目)裡面
        $("#date").html(days)
    })
}

</script>
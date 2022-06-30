<?php
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];
$session=$ss[$_GET['session']];

//上面只有把所有的狀態列出來,接下來要把幫我進到這個畫面的時候
//先把所有被訂購的座位拿出來給我看
//我這個場次的訂單有幾筆↓
$ords=$Ord->all(['movie'=>$movie['name'],'date'=>$date,'session'=>$session]); 
//↑這樣我就可以找到這個場次的所有訂單,接下來要把他的座位還原出來,並且把他變成陣列
//先設一個空陣列,然後我要一筆筆的把他的訂單還原出來
$seats=[];
// 每一個座位都是$ord的['seat']但現在他是字串,我們要還原成陣列
foreach($ords as $ord){
    //我們用serialize存到資料庫,unserialize還原
    //但單純還原陣列對我來說沒意義,我要把這三筆資料的陣列合併成一個
    //合併陣列之後把它變成一個新的陣列
    //array_merge把我現在的空陣列$seats去合併這一個放出來的陣列$ord['seat']
    //所以$seats會先用一個空陣列跟第一筆資料合併,合併完之後會成為一個新陣列
    //這時候陣列已經有兩個元素了,for迴圈第2次時,再去跟兩個元素的陣列合併變成4個
    //然後再跟一個就變成五個,所以我可以用這樣的方式把所有的陣列再一個迴圈裡面合併再一起
    //所以這個陣列裡面的東西就會是我們剛才很多筆資料還原出來的陣列
   $seats=array_merge($seats,unserialize($ord['seat']));
}
?>

<style>
#seats {
    display: flex;
    flex-wrap: wrap;
    width:540px;
    height:370px;
    /* 上右下左 */
    padding:19px 112px 12px 112px;
    margin:auto;
    background:url('icon/03D04.png');
    /* 加box-sizing:border-box才不會被padding影響我的總寬度 */
    box-sizing:border-box;
}

.seat {
    width: 63px;
    height: 85px;
    position:relative;
}

/* 沒有人的座位 */
.null{
    background:url('icon/03D02.png');
    background-position:center;
    background-repeat:no-repeat;
}
/* 有人的座位 */
.booked{
    /* 不是從api/booking來看,因為我是從index.php包進去的 */
    background:url('icon/03D03.png');
    /* 上面中間 */
    background-position:center;
    background-repeat:no-repeat;
}


.check{
    /* position:absolute會去找上層的relative來做定位,如果他網上找都找不到,就會找body */
    position:absolute;
    right:5px;
    bottom:5px;
}
</style>

<div id="seats">
    <?php
    //我有20個座位(不寫=20是因為這樣會變成21個)
    for($i=0;$i<20;$i++){
        //劃位做判斷,1.先檢查booked的狀況 in_array檢查我的$i有沒有在裡面,因為我的$i是0~19
        //我座位的序號也是0~19,如果我的$i有在$seats裡面表示座位被訂走了,那我要呈現的class就叫做booked
        $booked=in_array($i,$seats)?'booked':'null';
        echo "<div class='seat $booked'>";
        echo "  <div class='ct'>";
        //(取除數,然後因為我最小是0,可是我最小是1,所以這邊要再加1). "排"
        //(算餘數+1  因為我從0開始算,所以我的第一個值都是0,0+1我就會得到這個幾號)."號"
        echo    (floor($i/5)+1). "排".($i%5 +1)."號";
        echo "  </div>";
        // 如果我的座位$i不在$seats裡面,那表示還沒被訂走,所以畫面就可以show出來
        //建議不要用隱藏的方式,不然有心人會用f12去測試點選
        if(!in_array($i,$seats)){
            echo "<input type='checkbox' name='check' class='check' value='$i'>";
        }
        echo "</div>";
    }
    ?>
</div>

<div style="width:540px;margin:auto">
    <div>您選擇的電影是：<?=$movie['name'];?></div>
    <div>您選擇的時刻是：<?=$date;?> <?=$session;?></div>
    <div>您已經勾選了<span id="tickets"></span>張票，最多可以購買四張票</div>
    <div>
        <button onclick="prev()">回上一步</button>
        <button onclick="order()">完成訂購</button>
    </div>
</div>

<!-- js的控制必須是畫面載入之後你再去註冊事件才會生效
如果你把下面的js放在front/order的話不會生效
因為api/booking是從index client去跟我Server端的book要資料
我用ajax的方式去要資料,他回來之後放在畫面上呈現給我
然後我現在希望我拿到的資料點下去會有事件,所以他會產生一個問題
舞的index在一開始載入的時候,我的這個程式就已經存在了$.check,
$.check一開始就存在的話,我先寫在我front/order的頁面的時候,
我的這些內容(book)的頁面還沒有到這邊來,你就已經先註冊這些事件
這種時候就會發生一個問題,這個$.check在畫面上根本找不到任何東西
所以這個事件根本不會註冊(生效)
那我這個book ajax點下確定按鈕之後才會從伺服器端拿過來
拿過來之後這個東西已經有book的checkbox了,可是這個時候因為check已經先走了
所以你再怎麼去點他他都不會移動
所以應該要在我的內容產生之後,再去產生onchange註冊事件,他才會有效

再使用ajax時這點要特別注意
如果你ajax拉進來的頁面的內容之後要註冊事件
比如說click,hover之類的,這些動作要東西進到你的頁面之後才去執行,所以要寫在他的後面
所以與其我在這邊front/order.php做一個事情等他載入之後再做這些事情
到不如直接寫在booking.php裡面


-->
<script>
    // 先設全域變數,在js要new一個新的東西都是用物件的方法,
    // 不像php直接用直接用中誇號就可以產生新的陣列
let seats=new Array();
//在js陣列我要放進一個新的值我要用的方法是什麼?
//push後面推進去  pop後面彈出來
//onshift前面進去 shift從前面出來 
//splice()從中間,可以選從第幾個切片切出來或是取代掉
$(".check").on('click',function(){
    // 如果我點下去的狀況是true的話我就要做這些事情
    if($(this).prop('checked')){
        //在js裡怎麼之後我現在的陣列是多長?
        //在php用count
        //在js用length,什麼時候要用小誇號?用了跳錯誤就不要用,沒用跳錯誤就用,先這樣記
        //length用來計算字串長度,陣列長度 以屬性看
        if(seats.length<4){
            //不可以等於4的狀況去塞,因為我現在事先判斷裡面的長度有多少在讓我塞進去
            //也就是說這個動作是在長度$(this)之後再加一, 如果=4可以在進入來,表示我現在的seat陣列已經有4個了
            //已經有4個的狀況在+1進去就會變成5個
            //變成5個之後才提出警告
            //所以這邊的標準寫法是你要比你要的個數再少1
            seats.push($(this).val())
        }else{
            alert("最多只能勾選四張票")
            //跳出警告之後我們要阻止使用者繼續選(我勾選的狀況是在我push之前就發生了)
            //所以我要把我勾選的狀況取消掉
            //如何查詢checked box勾選狀況 js jq how to checke checkbox status 
            //prop全名是properties 屬性 可用來查詢某一個物件當前在記憶體中的狀態
            $(this).prop('checked',false)
        }
        // 如果是false(取消)的話我就要做這些狀況
    }else{
        //js 把資料從陣列中刪除
        //有達到array.splice 但這比較像更換,如果沒有換就直接刪除這樣
        //我要刪除元素但必須先找到索引值才能夠刪除
        //有沒有辦法先刪某個值?比較難,因為陣列搞不好會有重複的值,這樣可能會被直接刪除
        //用迴圈的方式的話又很麻煩
        //所以用splice比較好,但我要如何找到陣列裡面某個索引值?
        //我要先找到他,1是我從那個索引開始要刪除一個
        //索引我要告訴他seats. js所有的陣列都是一個物件,所以直接用點的方式
        //我是誰的某個東西,indexOf要找的是我的值,我的值來自哪裡?來自我點的當下的那個$(this).val()
        //我告訴他我點的當下的那個值在這的陣列裡面他是第幾個索引的東西
        //然後用那個索引值找到當下的內容,就可以刪掉這個東西
         seats.splice(seats.indexOf($(this).val()),1)
    }
    // 當我做完上面這些動作後我就去更新我畫面上那個tickets來告訴使用者你勾了幾張票
    $("#tickets").text(seats.length)
})

// 訂購 要送的資料包誇電影日期場次等等
function order(){
    // 複製front/order.php 表單資訊多了座位seats
    let order={id:$("#movie").val(),
               date:$("#date").val(),
               session:$("#session").val(),
               seats}
    // 送到後臺去做儲存的動作,改變資料表的話一般我們用post
    //還有一個原因,js的陣列用get沒辦法送
    //送order的資料,回給我result(除了結果,api還要幫我產生訂購完成的畫面)
    $.post('api/order.php',order,(result)=>{
        // result幫我蓋過去#mm
        $("#mm").html(result)
    })
}
</script>



<!-- 我們資料選完之後接下來就是要把他送到後台去
然後把它存到我們的訂單資訊裡面
訂單編號前8碼就是我們的y-m-b但是不要有那個-
用ID的方式產生流水號可是他要4碼所以我們要補0
我們位子是用js寫完之後產生1個陣列傳到後台，
請問陣列可以存到資料庫裡面嗎？陣列是沒有辦法直接存到資料庫裡面的
所以我們要想個方法，把陣列轉成字串然後存到資料庫裡面去

目前目前學的方法有什麼能把陣列轉成字串
1.implode，我們在base檔裡面用了很多implode的方法，把陣列改成可用某個像是符號或是逗號串起來的自串
所以implode可以幫我們把陣列串成字串
2.我們在講API的時候有稍微提到json encode，他也可以把陣列轉成字串的樣子，
不過他字串的形式各格式會比較特別，我們在講session的時候直接開type檔起來看，他前面會告訴你i還是s、多少長度，
然後他是用一個特殊符號把它分開的字串地形勢這些方法都可以把它轉成字串存到資料庫

但是用這些方法存到資料庫就要記得把它拿出來時就要再把它從字串轉成陣列來使用
因為我們只是為了要放到資料庫去，所以用轉成字串的方式，
但是用的時候還是要記得再用同樣的方式把他轉回陣列來使用
目前業界比較常用的方式有兩個
1.json encode是比較常用的方式
2.implide方式不太會用，會被笑

一個是用json encode，他在一些PHP比較新的框架中比較常用，
因為它可以把它轉回來之後直接丟給js用，
所以你的開發應用是偏向api方面的話用Jackson encode轉成字串丟進去就可以了
出來之後就用Json_decode的方式他就會變成陣列了 
一個是用serialize 意思是序列化(一個個東西排排站的意思)
-->
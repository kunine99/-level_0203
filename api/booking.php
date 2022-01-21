<!-- 等於20會跑21個，所以<20才對 -->
<?php
include_once "../base.php";
$movie=$Movie->find($_GET['id']);
$date=$_GET['date'];
$session=$ss[$_GET['session']];


// 合併陣列 php怎麼做
$ords=$Ord->all(['movie'=>$movie['name'],'date'=>$date,'session'=>$session]);
$seats=[];
foreach($ords as $ord){
   $seats=array_merge($seats,unserialize($ord['seat']));
}
?>



<style>
    #seats {
        display: flex;
        flex-wrap: wrap;
        width:540px;
        height:370px;
        padding:19px 112px 12px 112px;
        margin:auto;
        background:url('icon/03D04.png');
        box-sizing:border-box;
    }
    
    .seat {
        width: 63px;
        height: 85px;
        position:relative;
    }
    
    .null{
        background:url('icon/03D02.png');
        background-position:center;
        background-repeat:no-repeat;
    }
    
    .booked{
        background:url('icon/03D03.png');
        background-position:center;
        background-repeat:no-repeat;
    }
    
    
    .check{
        position:absolute;
        right:5px;
        bottom:5px;
    }
    </style>

<div id="seats">
    <?php

for($i=0;$i<20;$i++){
    $booked=in_array($i,$seats)?'booked':'null';
        echo "<div class='seat $booked'>";
    echo "  <div class='ct'>";
    echo    (floor($i/5)+1). "排".($i%5 +1)."號";
    echo "  </div>";
    if(!in_array($i,$seats)){
        echo "<input type='checkbox' name='check' class='check' value='$i'>";
    }    echo "</div>";
}
?>
</div>

<div style="width:540px;margin:auto">
    <div>您選擇的電影是：<?=$movie['name'];?></div>
    <div>您選擇的時刻是：<?=$date;?> <?=$session;?></div>
    <div>您已經勾選了<span id="tickets"></span>張票，最多可以購買四張票</div>
    <div>
        <button onclick="prev()">回上一步</button>
        <!-- 完成之後要做出送出訂單的動作 -->
        <button onclick="order()">完成訂購</button>    </div>
</div>


<script>
    let seats=new Array();
    // 我把一個東西序列化
    
    $(".check").on('click',function(){
        if($(this).prop('checked')){
            if(seats.length<4){
                // 如果我點下去的屬性是true的話我就做這些事情
                seats.push($(this).val())
            }else{
                alert("最多只能勾選四張票")
                // 如果不是我就從陣列裡面刪除 
                $(this).prop('checked',false)
            }
        }else{
            seats.splice(seats.indexOf($(this).val()),1)
        }
        $("#tickets").text(seats.length)
        function order(){
    let order={id:$("#movie").val(),
               date:$("#date").val(),
               session:$("#session").val(),
               seats}

    $.post('api/order.php',order,(result)=>{
        $("#mm").html(result)
    })
}
    })
    
</script>
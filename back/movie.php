<!-- 院線片 -->


<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div style="overflow:auto;height:420px;">
<?php
$mos=$Movie->all(" ORDER BY rank");

foreach ($mos as $key => $movie) {
// back的poster.php複製來的
$mos=$Poster->all(" ORDER by `rank`");
            foreach($mos as $key => $row){
                $checked=($row['sh']==1)?"checked":"";
                // mos是二微陣列，每一筆都慧倫一次把變數給row
                // 但沒有key 來當index(索引值?)? 
            if($key==0){
                $up=$row['id'] . "-" . $row['id'];
                $down=$row['id'] . "-" . $mos[$key+1]['id'];
            }

            if($key==(count($mos)-1)){
                $down=$row['id'] . "-" . $row['id'];
                $up=$row['id'] . "-" . $mos[$key-1]['id'];
            }

            if($key>0 && $key<(count($mos)-1)){
               $up=$row['id'] . "-" . $mos[$key-1]['id'];
               $down=$row['id'] . "-" . $mos[$key+1]['id'];
            }


?>

<div style="display:flex;width:100%;">
<div style="width:10%">
    <img src="img/<?=$movie['poster'];?>" style="width:100%">
</div>
<div style="width:10%">
    分級:
    <img src="icon/<?=$movie['level'];?>.png">
</div>
<div style="width:80%">
    <div style="display:flex">
        <div style="width:33%">片名:<?=$movie['name'];?></div>
        <div style="width:33%">片長:<?=$movie['length'];?></div>
        <div style="width:33%">上映時間:<?=$movie['ondate'];?></div>
    </div>
    <div style="text-align:right">
    <button class="show" data-id="<?=$movie['id'];?>">
            <?=($movie['sh']==1)?"顯示":"隱藏";?>
        </button>
        <button>往上</button>
        <button>往下</button>
        <button>編輯電影</button>
        <button onclick="location.href='?do=edit_movie&id=<?=$movie['id'];?>'">編輯電影</button>
        <button onclick="del('movie',<?=$movie['id'];?>)">刪除電影</button>

    </div>
    <div>
        劇情介紹：<?=$movie['intro'];?>
    </div>
</div>
</div>
<hr>
<?php
}
?>
</div>
</div>

<script>
$(".show").on("click",function(e){
    let id=$(e.target).data("id");
    $.post("api/show.php",{id},()=>{
        location.reload();
    })
})
/* $(".show").on("click",(e)=>{
    let id=$(e.target).data("id");
    $.post("api/show.php",{id},()=>{
        location.reload();
    })
}) */


/* $(".show").on("click",function(){
   
    let id=$(this).data("id");
    $.post("api/show.php",{id},()=>{
        location.reload();
    })
}) */
</script>
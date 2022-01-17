<style>
.lists *,
.controls *{
  box-sizing:border-box;
}
.lists{
  width:210px;
  height:260px;
  margin:auto;
  overflow:hidden;
}
.lists .po{
  width:100%;
  text-align:center;
  display:none;
}
.po img{
  width:100%;
  border:2px solid white;
}
.controls {
    display: flex;
    margin: auto;
    width: 100%;
    align-items:center;
    justify-content:space-evenly;
}
.icons {
    display: flex;
    width: 320px;
    height: 90px;
}
.icon{
  width:80px;
  height:20px;
}
.left {
  border-top:20px solid transparent;
  border-right:25px solid black;
  border-bottom:20px solid  transparent;
   /* border-left:25px solid  transparent; */
   cursor: pointer;
}
.right {
  border-top:20px solid transparent;
    /* border-right:25px solid transparent; */
    border-bottom:20px solid transparent;
    border-left:25px solid  black;
    cursor: pointer;
}
.left:hover{
  border-right:25px solid #555;
}
.right:hover{
  border-left:25px solid  #555;
}
</style>
<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div>
    <div class="lists">
    <?php
              $pos=$Poster->all(" where `sh`=1 Order By `rank`");
              foreach ($pos as $key => $po) {
                echo "<div class='po'>";
                echo "<img src='img/{$po['path']}'>";
                echo $po['name'];

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
$(".po").eq(0).show();

</script>    
<?php
// 帶id進來
$row = $Movie->find($_GET['id']);
?>
<div class="tab rb" style="width:87%;">
  <div style="background:#FFF; width:100%; color:#333; text-align:left">
    <!-- 影片檔名 -->
    <video src="img/<?= $row['trailer']; ?>" width="300px" height="250px" controls="" style="float:right;"></video>
    <font style="font-size:24px"> 
    <!-- 海報 -->
    <img src="img/<?= $row['poster']; ?>" width="200px" height="250px" style="margin:10px; float:left">
      <p style="margin:3px">影片名稱 ：<?= $row['name']; ?>
      <!-- 線上訂票連結 -->
        <input type="button" value="線上訂票" onclick="location.href='?do=order&id=<?= $row['id']; ?>'" style="margin-left:50px; padding:2px 4px" class="b2_btu">
      </p>
      <p style="margin:3px">影片分級 ： <img src="icon/<?= $row['level']; ?>.png" style="display:inline-block;">
      <!--請他到$Movie去找level的functionb,然後把我的level帶進去就會得到相應的文字   -->
      <?= $Movie->level($row['level']); ?></p>
      <!-- 在所有的程式語言中,取小時和剩下的分鐘的做法幾乎都一樣 因為這是常識
           除法+餘數感覺比較完整,一個算式就解決 -->
      <p style="margin:3px">影片片長 ：<?= floor($row['length']/60); ?>小時<?= $row['length']%60; ?>分</p>
      <!-- 如果很無聊想把-改成/ 就用str_replace -->
      <p style="margin:3px">上映日期 ：<?= $row['ondate']; ?></p>
      <p style="margin:3px">發行商 ：<?= $row['publish']; ?> </p> 
      <p style="margin:3px">導演 ：<?= $row['director']; ?> </p>
      <br>
      <br>
      <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br>
        <?= $row['intro']; ?>
      </p>
    </font>
    <table width="100%" border="0">
      <tbody>
        <tr>
          <!-- 回到首頁(院線片清單) -->
          <td align="center"><input type="button" value="院線片清單" onclick="location.href='index.php'"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
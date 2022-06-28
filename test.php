<style>
  .lists *,
  .controls * {
    box-sizing: border-box;
  }

  .lists {
    width: 210px;
    height: 260px;
    margin: auto;
    overflow: hidden;
    position: relative;
  }

  .lists .po {
    width: 100%;
    text-align: center;
    display: none;
    position: absolute;
  }

  .po img,
  .icon img {
    width: 100%;
    border: 2px solid white;
  }

  .controls {
    display: flex;
    margin: auto;
    width: 100%;
    align-items: center;
    justify-content: space-evenly;
  }

  .icons {
    display: flex;
    width: 320px;
    height: 110px;
    overflow: hidden;
    font-size: 12px;
  }

  .icon {
    width: 80px;
    flex-shrink: 0;
    padding: 5px;
    position: relative;
  }

  .left {
    border-top: 20px solid transparent;
    border-right: 25px solid black;
    border-bottom: 20px solid transparent;
    /* border-left:25px solid  transparent; */
    cursor: pointer;
  }

  .right {
    border-top: 20px solid transparent;
    /* border-right:25px solid transparent; */
    border-bottom: 20px solid transparent;
    border-left: 25px solid black;
    cursor: pointer;
  }

  .left:hover {
    border-right: 25px solid #555;
  }

  .right:hover {
    border-left: 25px solid #555;
  }
</style>
<div class="half" style="vertical-align:top;">
  <h1>預告片介紹</h1>
  <div class="rb tab" style="width:95%;">
    <div>
      <div class="lists">
        <?php
        $pos = $Poster->all(" where `sh`=1 Order By `rank`");
        foreach ($pos as $key => $po) {
          echo "<div class='po' data-ani='{$po['ani']}'>";
          echo "<img src='img/{$po['path']}'>";
          echo $po['name'];
          echo "</div>";
        }
        ?>
      </div>
      <div class="controls">
        <div class="left"></div>
        <div class="icons">
          <?php
          foreach ($pos as $key => $po) {
            echo "<div class='icon' data-ani='{$po['ani']}'>";
            echo "<img src='img/{$po['path']}'>";
            echo $po['name'];
            echo "</div>";
          }
          ?>
        </div>
        <div class="right"></div>
      </div>
    </div>
  </div>
</div>
<script>
  $(".po").eq(0).show();
  let i = 0;
  let all = $('.po').length;
  let slides = setInterval(() => {
    i++;
    if (i > all - 1) {
      i = 0;
    }
    ani(i);
  }, 2500);

  function ani(n) {
    let ani = $(".po").eq(n).data('ani');
    let now = $(".po:visible")
    let next = $(".po").eq(n)
    switch (ani) {
      case 1:
        //淡入淡出
        now.fadeOut(1000);
        next.fadeIn(1000);
        break;
      case 2:
        //縮放
        now.hide(1000, function() {
          next.show(1000);
        });
        break;
      case 3:
        //滑入滑出
        now.slideUp(1000, function() {
          next.slideDown(1000);
        });
        break;
    }
  }
  let p = 0;
  $(".left,.right").on("click", function() {
    if ($(this).hasClass('left')) {
      if (p - 1 >= 0) {
        p--;
      }
    } else {
      if (p + 1 <= all - 4) {
        p++;
      }
    }
    $(".icon").animate({
      right: p * 80
    }, 500)
  })

  $(".icon").on("click", function() {
    clearInterval(slides)
    let idx = $(this).index()
    ani(idx)

    i = idx

    slides = setInterval(() => {
      i++;
      if (i > all - 1) {
        i = 0;
      }
      ani(i);
    }, 2500);
  })
</script>
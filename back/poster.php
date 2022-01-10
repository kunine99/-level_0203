<!-- 預告片 -->
<div></div>
<div>
<h4 class='ct'>新增預告片海報</h4>
<form action="api/add_poster.php" method="post" enctype="multipart/form-data">
    <div class="ct">
        <label >
            預告片海報:
            <input type="file" name="path">
        </label>
        <label >
            預告片片名:
            <input type="text" name="name">
        </label>
    </div>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>
</div>


















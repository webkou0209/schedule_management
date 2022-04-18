<?php
$file_name = "data/info.csv";
if (file_exists($file_name)) {
    $f = fopen($file_name, "r");

    while ($tmp = fgetcsv($f)) {
        $info_data[] = $tmp;
    }
    fclose($f);
}


?>
<!DOCTYPE html>
<html lang="ja">

<!-- headファイル挿入 -->
<?php
include('./components/header.php');
?>


<body>

  <!-- navファイル挿入 -->
  <?php
  include('./components/nav.php');
  ?>

<div class="card bg-light mb-3" style="width: 90%; margin-left:5%; margin-right:5%; text-align:center;">
  <div class="card-header" style="font-size: x-large; font-weight:bold;"><i class="fas fa-info-circle"></i>  お知らせ</div>
  <div class="card-body">
    <h5 class="card-title"><?php echo $info_data[0][0];?></h5>
    <p class="card-text"><?php echo $info_data[1][0];?></p>
  </div>
</div>

<hr>

  <div class="card bg-primary text-white mb-3 mt-3" onclick="move_checkpage()" style="width: 90%; margin-left:5%; margin-right:5%; text-align:center;">
    <div class="card-body">
      <h3 class="card-body">スケジュール確認</h3>
    </div>
  </div>


  <div class="card text-white bg-success mb-3 mt-3" onclick="location.href='./info.php'" style="width: 90%; margin-left:5%; margin-right:5%; text-align:center;">
    <div class="card-body">
      <h3 class="card-body">お知らせ登録</h3>
    </div>
  </div>

 
</body>

</html>
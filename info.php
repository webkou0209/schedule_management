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

    <h1>お知らせ登録</h1>
    <div class="card border-primary mb-3" style="width: 90%; margin-left:5%; margin-right:5%; text-align:center;">
        <div class="card-body text-primary">
            <h5 class="card-title">トップページに表示するお知らせを変更できます．</h5>
            <h5 class="card-title">「確定」ボタンを押さないと反映されないので注意してください．</h5>


        </div>
    </div>


    <form action="change_info.php" method="POST">
        <div class="form-group">
            <label>お知らせタイトル</label>
            <input class="form-control form-control-lg" type="text" name="title" value=<?php echo $info_data[0][0];?>>
        </div>

        <div class="form-group">
            <label >お知らせ内容</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="contents" rows="5"><?php echo $info_data[1][0];?></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">確定</button>
    </form>

</body>

</html>
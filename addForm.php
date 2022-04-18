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

    <h1>予定登録ページ</h1>


    <form>
        <p>【STEP1】丸子に行く人を選択してください</p>
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" required>

            <option selected>登録者を選択してください</option>
            <option value="1">ぱありん</option>
            <option value="2">まありん</option>
            <option value="3">弘美</option>
            <option value="4">よっち</option>
            <option value="5">あゆ</option>
            <option value="6">ゆき</option>
            <option value="6">こう</option>
        </select>
        <hr>
        <p>【STEP2】丸子に行く日を選択してください</p>
        <div class="form-group" id="datepicker-default">

            <div class="col-sm-9 form-inline">
                <div class="input-group date">
                    <!-- ここにカレンダー表示用のテキストボックスを追加 -->
                    <input type="text" class="form-control" id="from" name="from" required>  
                </div>
            </div>
        </div>

        <hr>
        <p>【STEP3】丸子から帰る日を選択してください</p>
        <div class="form-group" id="datepicker-default">

            <div class="col-sm-9 form-inline">
                <div class="input-group date">
                   <!-- ここにカレンダー表示用のテキストボックスを追加 -->
                   <input type="text" class="form-control" id="to" name="to" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>
    </form>



    <!-- bootstrap-datepickerのjavascriptコード -->
    <script>
        $('#from').datepicker({
            format: 'yyyy/m/d',
            language: 'ja',
            autoclose: true,
        });
        $('#to').datepicker({
            format: 'yyyy/m/d',
            language: 'ja',
            autoclose: true,
        });

    </script>


</body>

</html>
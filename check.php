<?php
$year = $_GET["year"];
$month = $_GET["month"];


$file_name = "data/" . $year . "-" . $month . ".csv";
if (file_exists($file_name)) {
    $f = fopen($file_name, "r");
    $k = 1;
    while ($tmp = fgetcsv($f)) {
        $data[$k] = $tmp;
        $k++;
    }
    fclose($f);
} else {
    for ($k = 1; $k < 33; $k++) {
        for ($l = 1; $l < 10; $l++) {
            $data[$k][$l] = 0;
        }
    }
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


    <h1>スケージュール</h1>

    <div class="card border-primary mb-3" style="width: 90%; margin-left:5%; margin-right:5%; text-align:center;">
        <div class="card-body text-primary">
            <h5 class="card-title">予定は<i class='far fa-circle'></i>か<i class='fas fa-times'></i>で表示されます．</h5>
            <h5 class="card-title">予定を変更する場合，変更したい箇所(×か○のアイコン)をタップ（クリック）してください．</h5>
        </div>
    </div>

    <div style="font-size:30px; text-align:center; width:100%">
        <a href="#" id="beforeMonth">
            <i class="fas fa-angle-double-left"></i> </a>
        <label id="year"></label>年 <label id="month"></label>月</label>
        <a href="#" id="nextMonth"> <i class="fas fa-angle-double-right"></i></a>

    </div>






    <div class="table-responsive-sm" style="height:400px; padding:10 0 10 0; overflow-y:scroll;">
        <table class="table text-center text-nowrap">

            <tr style="height:20px">
                <th scope="col">日付</th>
                <th scope="col">Aさん</th>
                <th scope="col">Bさん</th>
                <th scope="col">Cさん</th>
                <th scope="col">Dさん</th>
                <th scope="col">Eさん</th>
                <th scope="col">Fさん</th>
                <th scope="col">Gさん</th>
                <th scope="col">Hさん</th>
                <th scope="col">Iさん</th>
            </tr>

            <?php
            $week = [
                '日', //0
                '月', //1
                '火', //2
                '水', //3
                '木', //4
                '金', //5
                '土', //6
            ];

            // 今日の日付取得
            $gettime = time();
            $today = date("Y/n/j");

            $maxday = 31;
            if ($month == 2) {
                $maxday = 28;
            } elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11) {

                $maxday = 30;
            }



            for ($i = 1; $i < $maxday + 1; $i++) {
                // 曜日取得→色指定
                $timestamp = mktime(0, 0, 0, $month, $i, $year);
                $date = date('w', $timestamp);
                if ($date == 0) {
                    $daycolor = "red";
                } else if ($date == 6) {
                    $daycolor = "blue";
                } else {
                    $daycolor = "black";
                }
                // 今日の列色変更
                $write_day = $year . "/" . $month . "/" . $i; //出力している日

                if ($today == $write_day) { //出力日が本日の場合背景色変更
                    echo "<tr  bgcolor='#ffb6c1'> <th scope='row'>" . $i . "(<label style='color:" . $daycolor . "'>" . $week[$date] . "</label>)<br>本日</th>";
                    for ($j = 0; $j < 9; $j++) {
                        $value = $data[$i + 1][$j + 1];
                        if ($value == 0) {
                            // 0の場合は☓を出力
                            echo "<td style='font-size: 20px; '><a class='trigger' data-toggle='modal' data-target='#exampleModalCenter' data-person='" . $j . "' data-day='" . $i . "'data-value='" . $value . "'><i class='fas fa-times'></i></a></td>";
                        } else if ($value == 1) {
                            // 1の場合は○を出力
                            echo "<td style='font-size: 20px; '><a class='trigger' data-toggle='modal' data-target='#exampleModalCenter' data-person='" . $j . "' data-day='" . $i . "'data-value='" . $value . "'><i class='far fa-circle'></i></a></td>";
                        }
                    }
                    echo "</tr>";
                } else { //出力日が本日以外のときは背景色そのまま
                    echo "<tr> <th scope='row'>" . $i . "(<label style='color:" . $daycolor . "'>" . $week[$date] . "</label>)</th>";
                    for ($j = 0; $j < 9; $j++) {
                        $value = $data[$i + 1][$j + 1];
                        if ($value == 0) {
                            // 0の場合は☓を出力
                            echo "<td style='font-size: 20px; '><a class='trigger' data-toggle='modal' data-target='#exampleModalCenter' data-person='" . $j . "' data-day='" . $i . "'data-value='" . $value . "'><i class='fas fa-times'></i></a></td>";
                        } else if ($value == 1) {
                            // 1の場合は○を出力
                            echo "<td style='font-size: 20px; '><a class='trigger' data-toggle='modal' data-target='#exampleModalCenter' data-person='" . $j . "' data-day='" . $i . "'data-value='" . $value . "'><i class='far fa-circle'></i></a></td>";
                        }
                    }
                    echo "</tr>";
                }
            }

            ?>


        </table>
    </div>

    <br>


    <!-- <button type="button" class="btn btn-primary btn-lg btn-block">フォームから予定を追加</button>

 -->


    <!-- Modal -->
    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">予定の変更</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size:25px; text-align:center;">
                    【変更前】<br><?php echo $year ?>年<?php echo $month ?>月<label id="modal_before_day"></label>日 <label id="modal_before_who"></label><br><label id="modal_before_value"></label><br>
                    <i class="fas fa-arrow-down"></i><br>

                    【変更後】<br><?php echo $year ?>年<?php echo $month ?>月<label id="modal_after_day"></label>日 <label id="modal_after_who"></label><br><label id="modal_after_value"></label></i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-primary" onclick="change_schedule()">変更する</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        var before_day = document.getElementById("modal_before_day");
        var after_day = document.getElementById("modal_after_day");
        var before_who = document.getElementById("modal_before_who");
        var after_who = document.getElementById("modal_after_who");
        var before_value = document.getElementById("modal_before_value");
        var after_value = document.getElementById("modal_after_value");

        var global_day = "";
        var global_who = "";
        var global_value = "";




        let url = new URL(window.location.href);
        // URLSearchParamsオブジェクトを取得
        let params = url.searchParams;
        var nowYear = Number(params.get('year'));
        var nowMonth = Number(params.get('month'));

        year.innerHTML = nowYear;
        month.innerHTML = nowMonth;

        // 次の月へボタンクリック
        document.getElementById("nextMonth").onclick = function() {
            if (nowMonth < 12) {
                var nextYear = nowYear;
                var nextMonth = nowMonth + 1;
            } else if (nowMonth >= 12) {
                var nextYear = nowYear + 1;
                var nextMonth = 1
            }
            let nextURL = "./check.php?year=" + nextYear + "&month=" + nextMonth;
            location.href = nextURL;
        };

        // 前の月へボタンクリック
        document.getElementById("beforeMonth").onclick = function() {
            if (nowMonth > 1) {
                var nextYear = nowYear;
                var nextMonth = nowMonth - 1;
            } else if (nowMonth <= 1) {
                var nextYear = nowYear - 1;
                var nextMonth = 12;
            }
            let nextURL = "./check.php?year=" + nextYear + "&month=" + nextMonth;
            location.href = nextURL;
        };


        // モーダルにパラメータ渡し
        $(function() {
            $(".trigger").click(function() {
                console.log("aaa");
                var person = $(this).data('person');
                var day = $(this).data('day');
                var value = $(this).data('value');

                // グローバル変数に値を渡す
                global_day = day;
                global_who = person;
                global_value = value;

                switch (person) {
                    case 0:
                        var person_name = "Aさん";
                        break;
                    case 1:
                        var person_name = "Bさん";
                        break;
                    case 2:
                        var person_name = "Cさん";
                        break;
                    case 3:
                        var person_name = "Dさん";
                        break;
                    case 4:
                        var person_name = "Eさん";
                        break;
                    case 5:
                        var person_name = "Fさん";
                        break;
                    case 6:
                        var person_name = "Gさん";
                        break;
                    case 7:
                        var person_name = "Hさん";
                        break;
                    case 8:
                        var person_name = "Iさん";
                        break;
                }
                switch (value) {
                    case 0:
                        var now_value = "<i class='fas fa-times'></i>";
                        var next_value = "<i class='far fa-circle'></i>";

                        break;
                    case 1:
                        var now_value = "<i class='far fa-circle'></i>";
                        var next_value = "<i class='fas fa-times'></i>";
                        break;

                }


                before_day.innerHTML = day;
                after_day.innerHTML = day;
                before_who.innerHTML = person_name;
                after_who.innerHTML = person_name;
                before_value.innerHTML = now_value;
                after_value.innerHTML = next_value;

            });

        });

        function change_schedule() {
            var change_url = "change_schedule.php?year=" + nowYear + "&month=" + nowMonth + "&day=" + global_day + "&who=" + global_who + "&value=" + global_value;
            location.href = change_url;
        }
    </script>
</body>
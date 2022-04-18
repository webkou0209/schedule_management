<?php
$year = $_GET["year"];
$month = $_GET["month"];
$day = $_GET["day"];
$who = $_GET["who"];
$value = $_GET["value"];


if ($value == 0) {
    $value = 1;
} else if ($value == 1) {
    $value = 0;
}


$file_name = "data/" . $year . "-" . $month . ".csv";
// ファイルが存在する
if (file_exists($file_name)) {
    $f = fopen($file_name, "r");
    $k = 1;
    while ($tmp = fgetcsv($f)) {
        $data[$k] = $tmp;
        $k++;
    }
    fclose($f);
    // データ書き換え
    $data[$day + 1][$who + 1] = $value;
}
// ファイルがないとき
else {
    $data[0][0] = "日付";
    $data[0][1] = "A";
    $data[0][2] = "B";
    $data[0][3] = "C";
    $data[0][4] = "D";
    $data[0][5] = "E";
    $data[0][6] = "F";
    $data[0][7] = "G";
    $data[0][7] = "H";
    $data[0][9] = "I";
    for ($k = 1; $k < 33; $k++) {
        $data[$k][0] = $k;
        for ($l = 1; $l < 10; $l++) {
            $data[$k][$l] = 0;
        }
    }
    // データ書き換え
    $data[$day][$who + 1] = $value;
}




// 書き込み
$f = fopen($file_name, "w");
foreach ($data as $fields) {
    fputcsv($f, $fields);
}
fclose($f);

$url = "check.php?year=" . $year . "&month=" . $month;
header("Location:$url");

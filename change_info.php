<?php
$title=$_POST["title"];
$contents=$_POST["contents"];

$file_name = "data/info.csv";
$f = fopen($file_name, "w");
$list = array (array($title),array($contents));
foreach ($list as $fields) {
    fputcsv($f, $fields);
}
fclose($f);

header("Location:index.php");
?>
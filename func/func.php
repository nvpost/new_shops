<?php

$home_url = $_SERVER['DOCUMENT_ROOT']."/sportforlive/";
$sql_count = 0;

require_once $home_url.'sql/sql_data_pass.php';


function deb($v, $h=0){
    if($h) echo "<hr>";
    echo "<pre>";
    print_r($v);
    echo "</pre>";
    if($h) echo "<hr>";
}
function c_deb($v){
    echo "<script>";
    echo "console.log('".$v."')";
    echo "</script>";
}

function pdSql($sql){
    global $sql_count;
    global $db;
    $res = $db->prepare($sql);
    $res->execute();
    $data = $res->fetchAll(PDO::FETCH_ASSOC);
    $sql_count++;

    return($data);

}
//подключаемыек файлы
require_once $home_url.'components/mainMenu.php';


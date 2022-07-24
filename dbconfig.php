<?php
Header('Access-Control-Allow-Origin: *');
Header('Access-Control-Allow-Headers: *');
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Content-Type: application/json; charset=UTF-8");
date_default_timezone_set('Asia/Bangkok');

$server = "<server>";
$username = "<username>";
$password = "<password>";
$database = "<database>";

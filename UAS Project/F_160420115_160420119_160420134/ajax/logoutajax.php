<?php
session_start();
header("Access-Control-Allow-Origin: *");
$arr = array('result' => 'logged out');
session_unset();
session_destroy();
echo json_encode($arr);
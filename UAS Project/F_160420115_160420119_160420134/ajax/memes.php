<?php
header("Access-Control-Allow-Origin: *");
extract($_POST);

$c = new mysqli("localhost", "kenserver", "kenserverdb42", "uas_fsp");
$limit = 8;
$start = ($page - 1) * $limit;
$sql = "SELECT * FROM meme LIMIT $start, $limit";
$stmt = $c->query($sql);
$return_memes = $stmt->fetch_all();
$c->close();

$c = new mysqli("localhost", "kenserver", "kenserverdb42", "uas_fsp");
$limit = 8;
$start = ($page - 1) * $limit;
$sql = "SELECT idmeme FROM user_likes_meme where iduser = $iduser";
$stmt = $c->query($sql);
$return_likes = $stmt->fetch_all();
$c->close();

$arrres = array();
if (count($return) <= 0) $arrres = array('result' => 'error', 'message' => 'Error while {$sql}'); 
$arrres = array('result' => 'success', 'data-memes' => $return_memes, 'data-likes' => $return_likes);

echo json_encode($arrres);



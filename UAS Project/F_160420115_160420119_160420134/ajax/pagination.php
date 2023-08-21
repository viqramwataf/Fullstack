<?php
session_start();
header("Access-Control-Allow-Origin: *");
extract($_POST);

$c = new mysqli("localhost", "kenserver", "kenserverdb42", "uas_fsp");
$sql = "SELECT COUNT(id) AS total_memes FROM meme;";
// $sql = "SELECT * FROM meme LIMIT 1, 8";
$stmt = $c->query($sql);
$total_memes = $stmt->fetch_assoc()['total_memes'];
$total_page = ceil($total_memes/8);
$c->close();

echo json_encode($total_page);

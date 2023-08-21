<?php
header("Access-Control-Allow-Origin: *");
extract($_POST);

$c = new mysqli("localhost", "kenserver", "kenserverdb42", "uas_fsp");
$c2 = new mysqli("localhost", "kenserver", "kenserverdb42", "uas_fsp");
$status = array("status" => "error", "liked"=> $liked);
if ($liked == "false") {
  $sql = "replace into user_likes_meme (iduser, idmeme) VALUES ($iduser, $idmeme);";
  $stmt = $c->query($sql);
  $sql = "update meme set likes = likes + 1 where id = $idmeme";
  $stmt = $c->query($sql);
  $status = array("status" => "inserted");
  
} else if ($liked == "true") {
  $sql = "DELETE FROM user_likes_meme WHERE iduser = $iduser and idmeme = $idmeme;";
  $stmt = $c->query($sql);
  $sql = "update meme set likes = likes - 1 where id = $idmeme";
  $stmt = $c->query($sql);
  $status = array("status" => "deleted");
}
$c->close();

echo json_encode($status);

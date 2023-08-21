<?php
session_start();
header("Access-Control-Allow-Origin: *");
extract($_POST);
$c = new mysqli("localhost", "kenserver", "kenserverdb42", "uas_fsp");
$sql = "SELECT * FROM user where username=? and password=?";
$stmt = $c->prepare($sql);
$stmt->bind_param("ss",$username, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($result-> num_rows > 0) {
$r = mysqli_fetch_assoc($result);
$arr=["result"=>"success","username"=>$r['username'],"id"=>$r["id"]];
$_SESSION["id"]=$r["id"];
}
else {
$arr= ["result"=>"error","message"=>"sql error: $sql"];
}
echo json_encode($arr);

?>
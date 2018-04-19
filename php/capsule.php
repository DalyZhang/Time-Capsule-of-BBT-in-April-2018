<?php

require("./config.php");
header("Content-Type: application/json");
// status: 0无错误, 1出错, 404not found
if(!isset($_POST['code']))
   exit;
$code = $_POST['code'];

$link = new mysqli($DOHOST, $DBUSER, $DBPSWD, $DBNAME);
if($link->connect_error){
   $data = [
      "status" => 1,
      "msg"    => "网络错误"
   ];
   echo json_encode($data);
   exit;
}

$stmt = $link->prepare("SELECT * FROM `timecapsule` WHERE `code`=?");
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
   $row = $result->fetch_assoc();
   if(!file_exists("$voice_path/$code.mp3")){ //判断音频存在否
      $voice = null;
   } else {
      $voice = "$voice_url_path/$code.mp3";
   }

   $data = [
      "status"     => 0,
      "receiver"   => htmlspecialchars($row['reciever']),
      "content"    => str_replace(" ", "&nbsp;", str_replace("\r\n", "<br>", $result["future"])),
      "voice"      => $voice
   ];
   echo json_encode($data);

}else {
   $data = [
      "status" => 404,
      "msg"    => "嘤嘤嘤找不到信"
   ];
   echo json_encode($data);
}

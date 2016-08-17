<?php
  include "../include/db.php";

  $result = array(
    "result"=>"failed"
  );

  if($_POST["url"]){
    $stmt = $db->prepare("INSERT INTO urls (target_url) VALUES (?)");
    if($stmt){
      $stmt->bind_param("s",$_POST["url"]);
      if($stmt->execute()){
        $result["result"] = "success";
        $result["id"] = $stmt->insert_id;
      } else {
        $result["reason"] = "Failed to execute statement";
      }
    } else {
      $result["reason"] = "Failed to prepare statement.";
    }
  } else {
    $result["reason"] = "No url";
  }

  header('Content-Type: application/json');
  echo json_encode($result);

?>

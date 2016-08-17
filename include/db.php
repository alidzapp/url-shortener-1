<?php
  $db = new MySQLi("172.16.1.90","dev","123467890","url_shortener");
  if($db->connect_error){
    echo json_encode(array("result"=>"failed","reason"=>$db->connect_error));
    die();
  }

  //I don't give a fuck about errors
?>

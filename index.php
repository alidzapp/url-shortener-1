<?php
  include "include/language_manager.php";
  include "include/db.php";
  $langMgr = new UrlShortener\LanguageManager("data/lang.json");
  if(!empty($_GET["h"])){
    $id = hexdec($_GET["h"]);
    $stmt = $db->prepare("SELECT * FROM urls WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows){
      $stmt->bind_result($resultId,$resultUrl);
      $stmt->fetch();
    }
  }
?>

<!doctype html>
<html>
  <head>
    <title><?php $langMgr->out("title"); ?></title>
    <link href="less/main.less" type="text/less" rel="stylesheet" />
    <script type="text/javascript" src="https://ssl.jackzh.com/file/js/less-js/less.min.js"></script>
    <script type="text/javascript" src="https://ssl.jackzh.com/file/js/jquery/jquery-2.2.2.min.js"></script>
  </head>

  <body>
    <div class="app-container">
      <h1><?php $langMgr->out("app-heading"); ?></h1>
      <h2><?php $langMgr->out("app-sub-heading"); ?></h2>
      <form>
        <p class="error" id="error"></p>
        <p class="success" id="success"><?php $langMgr->out("ready-for-use"); ?><br><b><span></span></b><br><?php $langMgr->out("another-url"); ?></p>
        <input class="primary-input" id="url-textbox" type="text" placeholder="<?php $langMgr->out("enter-url"); ?>" /><br>
        <button id="shorten-it-button" type="button"><?php $langMgr->out("shorten-it"); ?></button>
      </form>
      <p class="copyright">
        <a href="?lang=en">English</a> / <a href="?lang=zh">中文</a><br>
        &copy; Copyright Jack Zheng All Rights Reserved.<br>
        This web application is licenced under Creative Common Attribution 3.0 International.<br>
        less.js Copyright (c) 2009-2016 Alexis Sellier &amp; The Core Less Team Licensed under the Apache License.
      </p>
    </div>
  </body>
</html>
<script type="text/javascript">
  $("#url-textbox").focus(function(){
    $("#success").slideUp();
    $("#error").slideUp();
  });
  $("#shorten-it-button").click(function(){
    $("#shorten-it-button").prop('disabled', true);
    $("#error").slideUp();
    if($("#url-textbox").val() == ""){
      $("#error").text("Please enter an url");
      $("#error").slideDown();
    } else {
      $.ajax({
        url:"ajax/shorten_url.php",
        type:"POST",
        dataType:"json",
        data:{
          url:$("#url-textbox").val()
        },
        success:function(data){
          $("#shorten-it-button").prop('disabled', false);
          if(data["result"] == "success"){
            $("#success").slideDown();
            $("#success span").text("http://172.16.1.92/sf_SourceCode/url-shortener?h=" + data.id.toString(16));
          } else {
            $("#error").html("Oops, an error occoured...<br>" + data["reason"]);
            $("#error").slideDown();
          }
        },
        error:function(e){
          $("#shorten-it-button").prop('disabled', false);
          console.log(e);
        }
      });
    }
  });

  <?php if($resultUrl) { ?>
    window.location.href = "<?php echo $resultUrl; ?>";
  <?php } ?>
</script>

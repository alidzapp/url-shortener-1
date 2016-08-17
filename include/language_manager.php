<?php
  namespace UrlShortener;
  class LanguageManager {
    public $languageData;
    public $currentLanguage;

    function LanguageManager($languageFilePath){
      $this->__construct($languageFilePath);
    }

    //Fallback for PHP5
    function __construct($languageFilePath){
      $this->languageData = json_decode(file_get_contents($languageFilePath),true);
      if(empty($_GET["lang"])){
        $this->currentLanguage = $this->languageData["default-lang"];
      } else {
        $this->currentLanguage = $_GET["lang"];
      }

    }

    function out($param){
      echo $this->languageData["data"][$this->currentLanguage][$param];
    }
  }
?>

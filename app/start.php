<?php

  session_start();
  date_default_timezone_set('Asia/Manila');
  require_once("config/db.php");
  require_once("config/init.php");

  $baseurl = [];
  $js;

  if(isset($_GET['url'])) {
    $url = $_GET['url'];
    $end = substr($url, strlen($url)-1);
    if($end == "/") {
      $url = substr($url, 0, strlen($url)-1);
      header('Location: /practicumhub/' .$url);
    }
    $baseurl = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
  }
  else {
    $url = "/";
    $baseurl[] = $url;
  }

  $basecount = count($baseurl)-1;
  $bases = "";
  for($i = 0; $i < $basecount; $i++) {
    $bases = $bases. "../";
  }
  // print_r($baseurl);

?>

<?php
if (php_sapi_name() != "cli" && session_status() == PHP_SESSION_NONE) session_start();

//自動載入所以的php檔案  
$dir=@scandir(__DIR__);
if(is_array($dir)){
  foreach($dir as $item){
    $ext_filename=strtolower(pathinfo($item,PATHINFO_EXTENSION));  
    if($ext_filename=="php" && $item!="index.php"){
      require_once(__DIR__."/{$item}");
    }
  }
}

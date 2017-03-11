<?php
mb_regex_encoding('UTF-8');
mb_internal_encoding('UTF-8');

function str_pos($str,$keyword){
  $p=strpos($str,$keyword);
  if($p!==false){
    return $p;
  }
  else
    return -1;
}

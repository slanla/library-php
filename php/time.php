<?php
require_once(__DIR__."/string.php");
date_default_timezone_set('Asia/Taipei');

function UTCTimeOffset($time,$microtime=false){
  if($microtime){
    try{
      $t=DateTime::createFromFormat('U.u', floatval($time));
      if(is_object($t) && (get_class($t)=="DateTime")){
        $local = $t->setTimeZone(new DateTimeZone('Asia/Taipei'));
        return $local->format("Y-m-d\TH:i:s.uP");
      }
    }
    catch(Exception $e){
    }
  }
  else{
    try{
      $t=DateTime::createFromFormat('U.u', floatval($time));
      if(is_object($t) && (get_class($t)=="DateTime")){
        $local = $t->setTimeZone(new DateTimeZone('Asia/Taipei'));
        return $local->format("Y-m-d\TH:i:sP");
      }
    }
    catch(Exception $e){
    }
  }
  return date("Y-m-d\TH:i:sP",$time);
}
function ftime(){
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}

function ftimeString(){
  $time=ftime();
  
  try{
    $t=DateTime::createFromFormat('U.u', floatval($time));
    if(is_object($t) && (get_class($t)=="DateTime")){
      $local = $t->setTimeZone(new DateTimeZone('Asia/Taipei'));
      return $local->format("Y-m-d H:i:s.uP");
    }
  }
  catch(Exception $e){
  }
  
  return date("Y-m-d H:i:sP",$time);
}

function waitTime($time="2015-12-11T09:48:00+08:00"){
  if(is_string($time))  $time=strtotime($time);
  
  echo "waitTime: ".UTCTimeOffset($time)."\n";
  while(ftime()<$time){
    usleep(100);
  }
}

function getStrTime($string){
  $offset=0;
  $t=0;
  if(str_pos($string,"下午")){
    $string=str_replace("下午","",$string);
    $offset=86400/2;  //am->pm為平移12小時
  }
  if(str_pos($string,"上午"))
    $string=str_replace("上午","",$string);
  
  $tmp=explode(" ",$string);
  if(count($tmp)==2){
    $str=str_replace(":","-",$tmp[0])." ".$tmp[1];
    $t=strtotime($str);
    if($t){
      $t+=$offset;
    }
  }
  if($t==0){
    try{
      
      $date = new DateTime($string);
      $t=$date->getTimestamp();
      $t+=$offset;
      
    } catch (Exception $e) {
      //
    }
  }
  
  if($t)
    return date("Y-m-d H:i:s",$t);
  else
    return "";
}

function getStrDate($str){
  $str=str_replace(":","-",$str);
  $t=strtotime($str);
  if($t)
    return date("Y-m-d",$t);
  
  return 0;
}
<?php

function client_ip(){ //取得ip
	$ip=false;
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
		$ip=$_SERVER["HTTP_CLIENT_IP"];
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$ips=explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
		if ($ip) { array_unshift($ips, $ip); $ip=FALSE; }
		for ($i=0; $i < count($ips); $i++) {
      if(!match_ip("10.*.*.*",$ips[$i])){
				$ip=$ips[$i];
				break;
			}
		}
	}
  $ip=($ip ? $ip : $_SERVER['REMOTE_ADDR']);
  return $ip;
}

function match_ip($ip1,$ip2){
  $aip1=preg_split("[.]",$ip1,4);
  $aip2=preg_split("[.]",$ip2,4);
  if(sizeof($aip1)==4 && sizeof($aip2)==4 ) {
    for($i=0;$i<4;$i++){
      if(strpos($aip2[$i],"-")) {
        $v=preg_split("[-]",$aip2[$i],2);
        if(sizeof($v)==2){
          $v[0]=$v[0]*1;
          $v[1]=$v[1]*1;
          if(!($v[0]<=$aip1[$i] && $aip1[$i]<=$v[1]))
            return false;
        }
        else
          return false;
      }
      elseif(!($aip2[$i]=="*" || $aip1[$i]==$aip2[$i]))
        return false;
    }
    return true;
  }
  else
    return false;
}

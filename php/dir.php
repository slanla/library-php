<?php
function MakeDirectory($dir, $mode = 0777){
  if (is_dir($dir) || @mkdir($dir,$mode)) return TRUE;
  if (!MakeDirectory(dirname($dir),$mode)) return FALSE;
  return @mkdir($dir,$mode);
}
function mk_dir($dir, $mode = 0777){
  return MakeDirectory($dir,$mode);
}

function ls($path,$loop=true){
  $items=[];
  
  $files=scandir($path);
  
  foreach($files as $item){
    if($item!="." && $item!=".."){
      $file="{$path}/{$item}";
      if(is_dir($file) && $loop){
        $items=array_merge($items,ls($file));
      }
      else if(is_file($file)){
        $items[]=($file); //realpath
      }
    }
  }
  return $items;
}
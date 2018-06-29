<?php
function scan_dir(){
    $dir    = dirname(__FILE__)."/src";
    $files = scandir($dir, 1);
    return $files;
}
/*
foreach(scan_dir() as $a){
    echo $a."\n";
}
*/
?>
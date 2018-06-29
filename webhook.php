<?php

$payload = json_decode($HTTP_RAW_POST_DATA, true);
exec("cd src/Minutes-FUN ; git pull");
$path = dirname(__FILE__) .'/src/Minutes-FUN';
$file_list = scandir($path, 1);
if($file_list[0]=="README.md"){
    $file_name = $file_list[1];
}else{
   $file_name = $file_list[0];
}
$in_name = "/var/www/html/Minutes-Flow/src/Minutes-FUN/".$file_name;
$out_name = "/var/www/html/Minutes-Flow/tmp/".str_replace('.md', '.pdf', $file_name);
$command_1 = "cd src/Minutes-FUN";
$command_2 = "pandoc ".$in_name." -o ".$out_name." -V documentclass=ltjarticle --latex-engine=lualatex";
exec($command_1." ; ".$command_2);
exec("php mail.php")
//exec("cd src/Minutes-FUN ; pandoc README.md -o output.pdf -V documentclass=ltjarticle --latex-engine=lualatex");

?>
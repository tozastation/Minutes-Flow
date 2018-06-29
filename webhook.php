<?php
require 'scan_dir.php';

$LOG_FILE = dirname(__FILE__).'/hook.log';
$SECRET_KEY = 'hoge';　
$header = getallheaders();
$hmac = hash_hmac('sha1', $HTTP_RAW_POST_DATA, $SECRET_KEY);

if ( isset($header['X-Hub-Signature']) && $header['X-Hub-Signature'] === 'sha1='.$hmac ) {
    $payload = json_decode($HTTP_RAW_POST_DATA, true);  
    exec("cd src/Minutes-FUN ; git pull");
    $file_list = scan_dir("src/Minutes-Flow");
    $in_name = "/var/www/html/Minutes-Flow/src/Minutes-FUN".$file_list[0];
    $out_name = "/var/www/html/Minutes-Flow/tmp".str_replace('.md', '.pdf', $in_name);
    $command_1 = "cd src/Minutes-FUN";
    $command_2 = "pandoc ".$in_name." -o ".$out_name." -V documentclass=ltjarticle --latex-engine=lualatex";
    exec($command_1." ; ".$command_2);
    //exec("cd src/Minutes-FUN ; pandoc README.md -o output.pdf -V documentclass=ltjarticle --latex-engine=lualatex");
    file_put_contents($LOG_FILE, date("[Y-m-d H:i:s]")." ".$_SERVER['REMOTE_ADDR']." git pulled: ".$payload['after']." ".$payload['commits'][0]['message']."\n", FILE_APPEND|LOCK_EX);
} else {
    // 認証失敗
    file_put_contents($LOG_FILE, date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n", FILE_APPEND|LOCK_EX);
}

?>

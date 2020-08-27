<?php
header("Content-type:text/html;charset=utf-8;");

function recordip()
{
$remote = $_SERVER['REMOTE_ADDR'];//获取发信ip地址
$write = $remote . '|' . date('Y-m-d H:i:s');//记录时间
$str = file_get_contents('record.txt');//写入发信ip，记录在record.txt中
$clickcount = 1;
//判断是否写入文本
if($str){
$rows = explode("\r\n",$str);
$count = count($rows) + 1;
foreach($rows as $value){
$ip = explode("|",$value);
if($ip[0] == $remote){
$clickcount++;
}
}
$write = "\r\n" . $write;
}else{
$count = 1;
}
//写入文本
file_put_contents('record.txt',$write,FILE_APPEND);
}

?>

<?php
//调用发信配置函数文件
require_once("./functions.php");
//调用秘钥文件
require_once("./key.php");
//调用ip记录函数文件ip.php
require_once("./recordip.php");
//执行recordip.php中的函数(用于记录发信ip)
recordip();
//调用设置,获取请求参数，GET请求
$userName=$_GET['title'];
$content=$_GET['content'];
$address=$_GET['address'];
$Key=$_GET['key'];

/*post请求方法↓↓↓↓↓
$Name=$_POST['name'];
$userName=$_POST['title'];
$Content=$_POST['content'];
$mobile=$_POST['mobile'];
$address=$_POST['address'];
$Key=$_POST['key'];
****************/


//发件时间
$datetime = date("Y-m-d h:i:s", time()); //时间

//收件人
$email=$address;

//$subject为邮件标题
$subject = $userName;

//$content为邮件内容

/**如果您需要关闭秘钥，您可以把这段注释掉即可↓↓↓*****/
//秘钥判断
if(empty($Key))
{
echo '秘钥key不能为空！';
exit();
}
//进行判断key的正确性
if($setkey1==$Key||$setkey2==$Key||$setkey3==$Key||$setkey4==$Key||$setkey5==$Key)
{
//调用函数执行发信任务
$flag = sendMail($email,$subject,$content);
}else{
 echo '你的秘钥key错误！';
 exit();
}

//检测邮件是否发送成功
if($flag)
{
    //返回值，发送成功！
    $data =  '{"Code":"1","msg":"发送成功!"}';//json格式输出
    echo $data;
    exit();//代码终止
}else{
    //返回值，发送失败
    $data =  '{"Code":"-1","msg":"Error!发送失败Email"}';
    echo $data;
    exit();

}

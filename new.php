<head>
<?php
include("function.php");
include("config.php");
$url=$_GET['url'];//读取长URL
$Sfile=$_GET['file'];//读取短链接目录
$day=$_GET['day'];
if(stristr($url,"http")==false)
{
$url="http://".$url;
}
//开始运行GET
//执行目录、index文件创建
//判断目录文件是否给出
if($Sfile=='')
{
	$i=1;
	while(!is_dir($i))$i++;
	$Sfile=$i;
}
//判断目录是否存在或管理员直接覆盖
if(cha_dwz($Sfile)!=-1/*&&$_GET['key']!="admin"*/){echo "此短网址已被使用！";return;}
$filename="http://".$_SERVER['SERVER_NAME'];
if($_SERVER['SERVER_PORT']!=80&&$_SERVER['SERVER_PORT']!=443)
	$filename.=':'.$_SERVER['SERVER_PORT'];
$filename.='/?'.$Sfile;
echo "您的短链接是：<a style=\"text-decoration:none\" class=\"tl-price-input\" href =\"$filename\" target=\"_blank\">$filename&nbsp;</a>";//输出短链接地址
if(!$day||$day<1||$day>365)$day=31;
$date=date("Ymd")+floor($day/31)*100+$day%31;
$x=floor($date%100/31);
$date=$date-$x*31+$x*100;
$x=floor($date/100%100/12);
$date=$date-$x*1200+$x*10000;
$fp=fopen($value_file,"a");
fwrite($fp,"\n".$Sfile." ".$date." ".$url);
fclose($fp);
?>
<?php
header("Content-type: image/jpeg");

$width = 400;   //宽，高
$height = 400;

$image = imagecreate($width, $height); //第一步：创建空白图像

$white = imagecolorallocate($image, 0, 0, 0);  //第一次对 imagecolorallocate() 的调用会给基于调色板的图像填充背景色，即用 imagecreate() 建立的图像。

$green = imagecolorallocate($image, 0, 255, 0); //第二步：为图像分配颜色

imageline($image, 0, 20, 400, 20, $green);  //第三步：画线
imagerectangle($image,100,40,300,100,$green);  //画矩形
imagearc($image, 200, 150, 90, 90, 0, 360, $green); //画圆
imagestring($image, 14, 100, 240, "PHP is NiuBi HongHong!", $green); //写字符串

$str="abcdefghjklmnpqrstuvwxyz23456789";
$randstr = substr(str_shuffle($str), 0,4);
imagestring($image, 14, 100, 260, $randstr, $green); //验证码

imagettftext($image, 14, 0, 100, 300, $green, dirname(__FILE__) . './captcha.ttf', "中文vsEnglish");  //中文验证

imagejpeg($image,dirname(__FILE__) . "/img/" . time() . ".jpg");   //在当前路径下保存图片为test.jpg
//imagejpeg($image);  //第四步：不加文件名，直接输出到网页
//
//imagedestroy($image);   //第五步：销毁，回收资源

imagejpeg($image, dirname(__FILE__) . "/img/" . time() . ".jpg");

?>
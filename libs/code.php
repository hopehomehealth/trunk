<?php
session_start();
//生成验证码图片
Header("Content-type: image/PNG");
$im = imagecreate(66,18);
$back = ImageColorAllocate($im, 245,245,245);
imagefill($im,0,0,$back);
$scode=0;
srand((double)microtime()*1000000);
$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
$s1=rand(1,2);
imagestring($im, 5, 2+0*10, 1, $s1, $font);
$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
$s2=rand(1,9);
imagestring($im, 5, 2+1*10, 1, $s2, $font);
$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
imagestring($im, 5, 2+2*10, 1, '+', $font);
//$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
//$s3=rand(1,9);
//imagestring($im, 5, 2+3*10, 1, $s3, $font);
$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
$s4=rand(1,9);
imagestring($im, 5, 2+4*10, 1, $s4, $font);
$font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
imagestring($im, 5, 2+5*10, 1, '=', $font);
for($i=0;$i<100;$i++) //加入干扰象素
{
    $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
}
ImagePNG($im);
ImageDestroy($im);
$scode=$s1*10+$s2+$s4;
$_SESSION['sssscode'] = $scode;
?>
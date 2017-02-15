<?php
function resizeImage($im,$maxwidth,$maxheight,$name,$filetype)
 {
 $pic_width = imagesx($im); // 获取图像宽度函数
 $pic_height = imagesy($im); // 获取图像高度函数
 if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
 {
  if($maxwidth && $pic_width>$maxwidth)
  {
  $widthratio = $maxwidth/$pic_width; // 获取宽度比例
  $resizewidth_tag = true; // 此宽度变量为真
  }
  if($maxheight && $pic_height>$maxheight) 
  {
  $heightratio = $maxheight/$pic_height; // 获取高度比例
  $resizeheight_tag = true; // 此高度变量为真
  }
  if($resizewidth_tag && $resizeheight_tag)
  {
  if($widthratio<$heightratio) // 宽高比例的判断,取最小的比例进行缩放
   $ratio = $widthratio;
  else
   $ratio = $heightratio;
  }
  if($resizewidth_tag && !$resizeheight_tag)
  $ratio = $widthratio; 
  if($resizeheight_tag && !$resizewidth_tag)
  $ratio = $heightratio;
  $newwidth = $pic_width * $ratio; // 最新的比例宽度
  $newheight = $pic_height * $ratio; // 最新的比例高度
  if(function_exists("imagecopyresampled")) // 检测是否被定义
  {
  $newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数 建立的是一幅大小为 x和 y的黑色图像(默认为黑色) 
  // imagecreate 新建一个空白图像资源，用imagecolorAllocate()添加背景色
   imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数 使用重新采样复制和调整图像的一部分(将一个图像的矩形部分复制到另一图像，平滑地内插像素值，使得特别是减小图像的大小仍保持非常清楚。)
  }
  else
  {
  $newim = imagecreate($newwidth,$newheight); // 新建一个空白图像资源
   imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height); // 函数用于拷贝部分图像并调整大小 imagecopy() 函数用于拷贝图像或图像的一部分
  }
  $name = $name.$filetype;
  imagejpeg($newim,$name); // php输出图像
  imagedestroy($newim); // php销毁图像
 }
 else
 {
  $name = $name.$filetype;
  print_r($name);
  imagejpeg($im,$name);
 }
 }
//使用方法：
$im=imagecreatefromjpeg("./{5R26$5THY)%AO{VGPDR_K3.jpg");//参数是图片的存方路径
$maxwidth="100";//设置图片的最大宽度
$maxheight="100";//设置图片的最大高度
$name="123";//图片的名称，随便取吧
$filetype=".jpg";//图片类型
resizeImage($im,$maxwidth,$maxheight,$name,$filetype);//调用上面的函数

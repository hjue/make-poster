<?php

require('./circlecrop.php');

header('Content-Type: image/png');

$img = imagecreatefrompng('expand.png');

$font = 'lishu.ttf';
$text = '邀请卡';
$textcolor  = imagecolorallocate($img, 255, 255, 255);
imagettftext($img, 48, 0, 63, 46+30, $textcolor, $font, $text);

$font = 'heiti.ttf';
$text = '名字';
$textcolor  = imagecolorallocate($img, 0, 0, 0);
imagettftext($img, 14, 0, 184, 290, $textcolor, $font, $text);

$width = 156;
$height = 156;
$avatar_file = 'avatar.jpg';
list($width_orig, $height_orig) = getimagesize($avatar_file);
$ratio_orig = $width_orig/$height_orig;
if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
} else {
   $height = $width/$ratio_orig;
}
$avatar = imagecreatefromjpeg($avatar_file);
$thumb = imagecreatetruecolor($width, $height);
imagecopyresized($thumb, $avatar, 0, 0, 0, 0, $width, $height,$width_orig, $height_orig);

$crop = new CircleCrop($thumb);
$avatar_crop = $crop->crop()->image();

imagecopymerge($img, $avatar_crop, 151, 107, 0, 0, $width, $height, 100);

imagepng($img);
imagedestroy($img);

<?php
/*
include_once 'Snoopy.class.php';
$snoopy = new snoopy;
$snoopy->fetch("http://www.naver.com");
$txt = $snoopy->results;
print_r($txt);
*/
function average($img) {
    $w = imagesx($img);
    $h = imagesy($img);
    $r = $g = $b = 0;
    for($y = 0; $y < $h; $y++) {
        for($x = 0; $x < $w; $x++) {
            $rgb = imagecolorat($img, $x, $y);
            $r += $rgb >> 16;
            $g += $rgb >> 8 & 255;
            $b += $rgb & 255;
        }
    }
    $pxls = $w * $h;
    $r = dechex(round($r / $pxls));
    $g = dechex(round($g / $pxls));
    $b = dechex(round($b / $pxls));
    if(strlen($r) < 2) {
        $r = 0 . $r;
    }
    if(strlen($g) < 2) {
        $g = 0 . $g;
    }
    if(strlen($b) < 2) {
        $b = 0 . $b;
    }
    return "#" . $r . $g . $b;
}
$im= imagecreatefromjpeg(".\\view\account\memberimg\dd\img\아를밤의카페.jpg");
echo average($im);
use AvgColorPicker;

function getAverage($sourceURL){

    $image = imagecreatefromjpeg($sourceURL);
    $scaled = imagescale($image, 1, 1, IMG_BICUBIC);
    $index = imagecolorat($scaled, 0, 0);
    $rgb = imagecolorsforindex($scaled, $index);
    $red = round(round(($rgb['red'] / 0x33)) * 0x33);
    $green = round(round(($rgb['green'] / 0x33)) * 0x33);
    $blue = round(round(($rgb['blue'] / 0x33)) * 0x33);
    return sprintf('#%02X%02X%02X', $red, $green, $blue);
}


   $imageAvgHexColor = (new AvgColorPicker)->getImageAvgHexByPath('https://cdn.pixabay.com/photo/2016/02/27/06/43/cherry-tree-1225186__340.jpg');
   echo "이미지 색상";
print_r($imageAvgHexColor);
 ?>
 <div style="background-color: <?= $imageAvgHexColor ?>; width: <?= $imageWidth ?>; height: <?= $imageHeight ?>;">
     <img src="https://cdn.pixabay.com/photo/2016/02/27/06/43/cherry-tree-1225186__340.jpg" alt="">
 </div>

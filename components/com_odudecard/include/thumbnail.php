<?php
 
/*
File: thumbs.php
Example: <img src="thumbs.php?filename=photo.jpg&amp;width=100&amp;height=100">
*/
 
$filename= $_GET['filename'];
$width = $_GET['width'];
$height = $_GET['height'];
//$path="http://localhost/demo/media/"; //finish in "/"
$path=$_GET['path']; 
// Content type
header('Content-type: image/jpeg');
 
// Get new dimensions
list($width_orig, $height_orig) = getimagesize($path.$filename);
 
if ($width && ($width_orig < $height_orig)) {
   $width = ($height / $height_orig) * $width_orig;
} else {
   $height = ($width / $width_orig) * $height_orig;
}
 
// Resample
$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromjpeg($path.$filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
 
// Output
imagejpeg($image_p, null, 100);
 
// Imagedestroy
imagedestroy ($image_p);
?>

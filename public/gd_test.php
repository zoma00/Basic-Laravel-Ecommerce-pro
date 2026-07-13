<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$im = imagecreate(100, 100);
$bg_color = imagecolorallocate($im, 0, 255, 0); // Green background
$image_path = 'test_image.png';  // Image path
imagepng($im, $image_path);
imagedestroy($im);

// Display the created image
echo '<img src="'.$image_path.'" alt="Test Image">';

echo 'Test image created!';

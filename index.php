<?php
// Patterny by Steve Attewell
// call this page with index.php?a=your-text-goes-here 
// and a PNG with a lovely unique pattern will be returned

$a = $_GET['a'] ?? null;



$hashFunction = $_GET['hashfunction'] ?? "crc32";
$allowedHashFunctions = array('crc32', 'md5', 'sha1', 'sha256', 'sha512');

if(!$a){
    die("You must include a querystring parameter called 'a'. e.g. ?a=your-text-here ... you may also optinally include pizelsize=[the size of each 'custom' pixel (in real pxels!) between 1 and 60] and imagesize=[the number of 'custom' pixels wide the image should be]. Images will be constrained to a maxiumum of 600 real pixels wide. ?hashfuction can be one of: " . implode(', ', $allowedHashFunctions));
}

$pixelSize = $_GET['pixelsize'] ?? 18;
$imageSize = $_GET['imagesize'] ?? 20;

$pixelSize = max(1, min(60, $pixelSize));
$imageSize = max(1, min(600/$pixelSize, $imageSize));

if (in_array($hashFunction, $allowedHashFunctions)) {
    // The hash function is allowed
    if ($hashFunction == "crc32"){
        $key = crc32($a);
    } else {
        $key = hexdec(hash($hashFunction, $a));
    }
} else {
    // The hash function is not allowed
    die("Unknown 'hashfunction'. Must be one of " . implode(', ', $allowedHashFunctions));
}


//$key = rand();

// Set the dimensions of the image
$width = $imageSize;
$height = $imageSize;
//$pixelSize = 10;
// Create a new image with the specified dimensions
$image = imagecreatetruecolor($width * $pixelSize, $height * $pixelSize);

// Loop through each block of 10x10 pixels in the image
for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {

        // Loop through each pixel in the current block
        for ($i = 0; $i < $pixelSize; $i++) {
            for ($j = 0; $j < $pixelSize; $j++) {
                $pixel_x = $x * $pixelSize + $i;
                $pixel_y = $y * $pixelSize + $j;

                // Generate a random value between 0 and 1 using the key seed
                $value = fmod(sin($x * $key + $y) + 1, 1);
                $color = intval($value * 255);
                $red = max(0, min(255, $color));

                $value = fmod(sin(($x+0.05) * $key + $y) + 1, 1);
                $color = intval($value * 255);
                $green = max(0, min(255, $color));

                $value = fmod(sin(($x+0.5) * $key + $y) + 1, 1);
                $color = intval($value * 255);
                $blue = max(0, min(255, $color));

                // Allocate the color and set the current pixel
                $pixel_color = imagecolorallocate($image, $red, $green, $blue);
                imagesetpixel($image, $pixel_x, $pixel_y, $pixel_color);
            }
        }
    }
}


// Output the image as a PNG
header('Content-Type: image/png');
imagepng($image);

// Destroy the image resource to free up memory
imagedestroy($image);
?>

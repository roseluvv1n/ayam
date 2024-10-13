<?php
function resizeImage($sourcePath, $maxWidth, $maxHeight, $destinationPath) {
    list($originalWidth, $originalHeight, $imageType) = getimagesize($sourcePath);
    
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($sourcePath);
            break;
        default:
            return false; // Unsupported image type
    }
    
    $aspectRatio = $originalWidth / $originalHeight;

    if ($originalWidth > $originalHeight) {
        $newWidth = $maxWidth;
        $newHeight = $maxWidth / $aspectRatio;
    } else {
        $newWidth = $maxHeight * $aspectRatio;
        $newHeight = $maxHeight;
    }

    if ($newWidth > $maxWidth) {
        $newWidth = $maxWidth;
        $newHeight = $maxWidth / $aspectRatio;
    }
    if ($newHeight > $maxHeight) {
        $newHeight = $maxHeight;
        $newWidth = $maxHeight * $aspectRatio;
    }
    
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    
    // Preserve transparency for PNGs
    if ($imageType == IMAGETYPE_PNG) {
        imagealphablending($newImage, false);
        imagesavealpha($newImage, true);
        $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
        imagefill($newImage, 0, 0, $transparent);
    }
    
    // Resize image
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
    
    // Save resized image to the destination path
    switch ($imageType) {
        case IMAGETYPE_JPEG:
            imagejpeg($newImage, $destinationPath);
            break;
        case IMAGETYPE_PNG:
            imagepng($newImage, $destinationPath);
            break;
    }
    
    // Free memory
    imagedestroy($image);
    imagedestroy($newImage);
    
    return true;
}
?>

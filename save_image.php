<?php
if (isset($_POST['image'])) {
    $data = $_POST['image'];

    // Remove the base64 part from the image data
    $imageData = explode(',', $data)[1];

    // Decode the base64 data
    $imageData = base64_decode($imageData);

    // Generate a unique filename
    $fileName = 'cropped_image_' . time() . '.png';

    // Save the image file
    file_put_contents('signatures/' . $fileName, $imageData);

} else {
    echo 'We found bad time while capturing ';
}


<?php

session_start();

require "vendor/autoload.php";


use Google\Cloud\Vision\VisionClient;
$vision = new VisionClient(['keyFile' => json_decode(file_get_contents("key.json"), true)]);

$familyPhotoResource = fopen($_FILES['image']['tmp_name'], 'r');

$image = $vision->image($familyPhotoResource, ['WEB_DETECTION']);
$result = $vision->annotate($image);

// if ($result) {
//     $imagetoken = random_int(1111111, 999999999);
    
// } else {
//     header("location: index.php");
//     die();
// }

// $logos = $result->logos();
$web = $result->web();
$descAlert = ucfirst($web->entities()[0]->info()['description']);
$descArray = explode(" ",$descAlert);
$searchString = $descArray[count($descArray) - 1];
include "index.php";
echo '<script type="text/javascript">  document.getElementById("searchArea").value = "'.$searchString.'"; test2();</script>'
?>

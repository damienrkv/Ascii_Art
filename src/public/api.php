<?php

require __DIR__ . "/../config/database.php";

$url = $_SERVER["REQUEST_URI"];

switch ($url) {

    case "/api/random":
        require __DIR__ . "/../controllers/RandomController.php";
        getRandomArt($db);
        break;

    case "/api/convert":
        require __DIR__ . "/../controllers/UploadController.php";
        require __DIR__ . "/../controllers/ConvertController.php";
        convertArt($db);
        break;

    case "/api/uploads":
        require __DIR__ . "/../controllers/UploadController.php";
        showUploads($db);
        break;

    default:
        http_response_code(404);
        echo json_encode([
            "error" => "Route not found"
        ]);
}
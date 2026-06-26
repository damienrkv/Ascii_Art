<?php

require "../config/database.php";


$url = $_SERVER["REQUEST_URI"];


switch ($url) {


    case "/api/random":

        require "../controllers/RandomController.php";

        getRandomArt($db);

        break;



    case "/api/convert":

        require "../controllers/ConvertController.php";

        convertArt($db);

        break;



    case "/api/uploads":

        require "../controllers/UploadController.php";

        showUploads($db);

        break;



    default:

        http_response_code(404);

        echo json_encode([
            "error" => "Route not found"
        ]);

}
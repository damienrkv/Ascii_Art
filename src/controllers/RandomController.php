<?php
function getRandomArt($db) {
    header('Content-Type: application/json');

    $sql = "SELECT ascii_art FROM uploads ORDER BY RAND() LIMIT 1";
    $result = $db->query($sql);

    $response = array();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ascii_art = nl2br(str_replace(' ', '&nbsp;', $row['ascii_art']));
        $response['ascii_art'] = $ascii_art;
    } else {
        $response['ascii_art'] = null;
    }

    echo json_encode($response);
}
?>

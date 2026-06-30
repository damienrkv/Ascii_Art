<?php
function generate_ascii_art($image_path, $max_chars, $inverted)
{
    $ascii_chars = '@%#*+=-:. ';
    if ($inverted) {
        $ascii_chars = strrev($ascii_chars);
    }
    $num_chars = strlen($ascii_chars);

    $image = imagecreatefromstring(file_get_contents($image_path));
    $width = imagesx($image);
    $height = imagesy($image);

    $aspect_ratio = $height / $width;
    $new_width = intval(sqrt($max_chars / $aspect_ratio));
    $new_height = intval($new_width * $aspect_ratio * 0.55);

    $resized_image = imagescale($image, $new_width, $new_height);
    imagedestroy($image);

    $ascii_art = '';
    for ($y = 0; $y < $new_height; $y++) {
        for ($x = 0; $x < $new_width; $x++) {
            $gray = 255 - ((imagecolorat($resized_image, $x, $y) >> 16) & 0xFF);
            $ascii_char = $ascii_chars[intval($gray / 256 * $num_chars)];
            $ascii_art .= $ascii_char;
        }
        $ascii_art .= "<br>";
    }

    imagedestroy($resized_image);
    return $ascii_art;
}

function convertArt($db)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']) && isset($_POST['max_chars'])) {
            $image_path = $_FILES['image']['tmp_name'];
            $max_chars = intval($_POST['max_chars']);
            $inverted = isset($_POST['inverted']);

            $ascii_art = generate_ascii_art($image_path, $max_chars, $inverted);

            $uploadDir = __DIR__ . "/../uploads/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $filename = uniqid() . "_" . basename($_FILES["image"]["name"]);
            $target = $uploadDir . $filename;

            move_uploaded_file($_FILES["image"]["tmp_name"], $target);

            $imagePath = "uploads/" . $filename;
            $num_chars = strlen(strip_tags($ascii_art));

            // Prepared Statement
            $stmt = $db->prepare(
                "INSERT INTO uploads (image_path, ascii_art, num_chars)
                VALUES (?, ?, ?)"
            );

            $stmt->bind_param("ssi", $imagePath, $ascii_art, $num_chars);

            if ($stmt->execute()) {
                echo "Upload erfolgreich.";
            } else {
                echo "Fehler: " . $stmt->error;
            }
            ?>

            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <title>ASCII Art</title>
            </head>

            <body>

                <h2>ASCII Art</h2>
                <div id="ascii_art" style="font-family: monospace; white-space: pre;">
                    <?php echo $ascii_art; ?>
                </div>

                <button onclick="copyAsciiArt()">Kopieren</button>

                <script>
                    function copyAsciiArt() {
                        const asciiArtElement = document.getElementById('ascii_art');
                        const range = document.createRange();
                        range.selectNode(asciiArtElement);
                        window.getSelection().removeAllRanges();
                        window.getSelection().addRange(range);
                        document.execCommand('copy');
                        window.getSelection().removeAllRanges();
                        alert('ASCII-Art wurde kopiert!');
                    }
                </script>

                <br><br>
                <a href="damien.html">Zurück zur Konvertierungsseite</a>

                <h2>Bisherige Uploads</h2>
                <div id="uploads">
                    <?php showUploads($db); ?>
                </div>

            </body>

            </html>
            <?php
        }
    }
}
?>
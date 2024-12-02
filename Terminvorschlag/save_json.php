<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');

    // Überprüfen, ob JSON valide ist
    if (json_decode($jsonData) !== null) {
        file_put_contents('options.json', $jsonData);
        echo 'JSON-Datei erfolgreich gespeichert!';
    } else {
        echo 'Fehler: Ungültiges JSON-Format.';
    }
}
?>

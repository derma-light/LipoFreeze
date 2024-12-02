<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//echo 'Formular wurde abgeschickt';
// Daten aus dem Formular erhalten
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$behandlung = isset($_POST['behandlung']) ? $_POST['behandlung'] : '';
$woche = isset($_POST['woche']) ? $_POST['woche'] : '';
$start = isset($_POST['start']) ? $_POST['start'] : '';
$ende = isset($_POST['ende']) ? $_POST['ende'] : '';
$woche2 = isset($_POST['woche2']) ? $_POST['woche2'] : '';
$start2 = isset($_POST['start2']) ? $_POST['start2'] : '';
$ende2 = isset($_POST['ende2']) ? $_POST['ende2'] : '';
$woche3 = isset($_POST['woche3']) ? $_POST['woche3'] : '';
$start3 = isset($_POST['start3']) ? $_POST['start3'] : '';
$ende3 = isset($_POST['ende3']) ? $_POST['ende3'] : '';
$notiz = isset($_POST['notiz']) ? $_POST['notiz'] : '';

// Schritt 1: Senden einer E-Mail mit der PHP mail()-Funktion
$to = 'ralf.kreppein@googlemail.com';
$cc = 'info@dermalight-hamburg.de';
$subject = 'Neue Terminvorschläge vom Kontaktformular';
$message = "Vorname: $firstName\nNachname: $lastName\nE-Mail: $email\nBehandlung: $behandlung\n" .
    "Vorschlag 1 - Datum: $woche, Frühestens: $start, Spätestens: $ende\n" .
    "Vorschlag 2 - Datum: $woche2, Frühestens: $start2, Spätestens: $ende2\n" .
    "Vorschlag 3 - Datum: $woche3, Frühestens: $start3, Spätestens: $ende3\n" .
    "Notiz: $notiz";
$headers = 'From: info@dermalight-hamburg.de' . "\r\n" .
           'Reply-To: ' . $email . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// E-Mail senden
if (mail($to, $subject, $message, $headers)) {
    echo '';
} else {
    echo 'Fehler beim Senden der E-Mail.';
}

// Schritt 2: Speichern der Daten in einer CSV-Datei
$filePath = 'Data.csv'; // Ersetze den Pfad durch den tatsächlichen Pfad auf deinem Server

// Öffnen oder erstellen der CSV-Datei
$file = fopen($filePath, 'a'); // 'a' für "append" (Daten anfügen)

// Schreiben der Daten in die CSV-Datei
fputcsv($file, [$firstName, $lastName, $email, $behandlung, $woche, $start, $ende, $woche2, $start2, $ende2, $woche3, $start3, $ende3, $notiz]);

// Datei schließen
fclose($file);

echo '<div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; border: 1px solid #ddd; max-width: 600px; margin: 20px auto; text-align: center;">
        <h2 style="color: #4CAF50;">Vielen Dank für Ihre Terminvorschläge!</h2>
        <p style="font-size: 16px; color: #333;">Ihre Anfrage wurde erfolgreich an uns übermittelt.</p>
        <p style="font-size: 16px; color: #333;">Bitte beachten Sie, dass dies noch keine feste Terminbuchung ist.</p>
        <p style="font-size: 16px; color: #333;">Wir melden uns schnellstmöglich mit einer Bestätigung bei Ihnen.</p>
      </div>';
?>

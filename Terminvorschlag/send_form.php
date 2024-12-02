<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // E-Mail-Empfänger
    $to = "info@dermalight-Hamburg.de";
	$cc = "kreppein@vodafone.de";
    $subject = "Terminänderung";

    // Formularwerte
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mitteilung = isset($_POST['mitteilungInput']) ? $_POST['mitteilungInput'] : '';
    $vorschlag = isset($_POST['vorschlagInput']) ? $_POST['vorschlagInput'] : '';

    // Nachricht erstellen
    $message = "Terminänderung:\n\n";
    $message .= "Aktion: " . $action . "\n";
    $message .= "E-Mail: " . $email . "\n";

    if ($action == "verschieben") {
        $message .= "Terminvorschlag: " . $vorschlag . "\n";
    } elseif ($action == "stornieren") {
        $message .= "Mitteilung (optional): " . $mitteilung . "\n";
    }

    // E-Mail-Header
    $headers = "From: "info@dermalight-hamburg.de"\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // E-Mail senden
    if (mail($to, $subject, $message, $headers)) {
        echo "Die Nachricht wurde erfolgreich gesendet.";
    } else {
        echo "Die Nachricht konnte nicht gesendet werden.";
    }
}
?>

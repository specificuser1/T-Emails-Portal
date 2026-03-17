<?php
require "db.php";
require "config.php";

$action = $_GET["action"] ?? "";

// Delete mail
if ($action == "delete") {
    $id = $_POST["id"];
    $db->prepare("DELETE FROM mails WHERE id=?")->execute([$id]);
    echo "OK";
    exit;
}

// Download inbox
if ($action == "download") {
    session_start();
    $email = $_SESSION["temp_email"];

    $stm = $db->prepare("SELECT * FROM mails WHERE email=?");
    $stm->execute([$email]);
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=inbox.txt");
    foreach ($rows as $mail) {
        echo "From: {$mail['sender']}\nSubject: {$mail['subject']}\nMessage:\n{$mail['message']}\n\n---\n\n";
    }
    exit;
}

// Webhook receiver
if ($action == "webhook") {
    $token = $_GET["token"];
    if ($token !== $WEBHOOK_TOKEN) die("Invalid token");

    $data = json_decode(file_get_contents("php://input"), true);

    $stm = $db->prepare("
        INSERT INTO mails (email, sender, subject, message)
        VALUES (?, ?, ?, ?)
    ");

    $stm->execute([
        $data["to"],
        $data["from"],
        $data["subject"],
        $data["message"]
    ]);

    echo "Mail stored.";
}

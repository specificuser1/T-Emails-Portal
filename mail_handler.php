<?php
$data = json_decode(file_get_contents("php://input"), true);

$email = $data["to"] ?? "";
$from = $data["from"] ?? "Unknown";
$subject = $data["subject"] ?? "(No subject)";
$message = $data["message"] ?? "";

$filename = "mails/" . md5($email) . ".json";

// Load existing
$mails = [];
if (file_exists($filename)) {
    $mails = json_decode(file_get_contents($filename), true);
}

// Add new mail
$mails[] = [
    "from" => $from,
    "subject" => $subject,
    "message" => $message,
    "date" => date("Y-m-d H:i:s")
];

// Save
file_put_contents($filename, json_encode($mails, JSON_PRETTY_PRINT));
echo "Mail saved!";

<?php
require "db.php";
session_start();

$email = $_SESSION["temp_email"];
$query = $_GET["q"] ?? "";

$stm = $db->prepare("SELECT * FROM mails WHERE email=? AND (subject LIKE ? OR message LIKE ?) ORDER BY id DESC");
$stm->execute([$email, "%$query%", "%$query%"]);
$mails = $stm->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($mails);

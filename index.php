<?php
require "config.php";
session_start();

function makeEmail($domains) {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $prefix = substr(str_shuffle($chars), 0, 10);
    $domain = $domains[array_rand($domains)];
    return "$prefix@$domain";
}

if (!isset($_SESSION["temp_email"])) {
    $_SESSION["temp_email"] = makeEmail($MAIL_DOMAINS);
}
$email = $_SESSION["temp_email"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Temp Mail | BY SUBHAN</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>

<body class="glass">
    <div class="box">
        <h1>T-Mail Doctor</h1>

        <div class="email-box">
            <input type="text" id="email" value="<?php echo $email; ?>" readonly />
            <button onclick="copyEmail()">Copy</button>
        </div>

        <a href="inbox.php" class="btn">Open Inbox</a>
        <button class="btn" onclick="toggleTheme()">Switch Theme</button>
    </div>
</body>
</html>

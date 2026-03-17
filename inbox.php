<?php
session_start();
if (!isset($_SESSION["temp_email"])) header("Location: index.php");
$email = $_SESSION["temp_email"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inbox – <?php echo $email; ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/popup.css">
    <script src="assets/script.js"></script>
</head>

<body class="glass">
    <div class="box">
        <h2>Your Inbox</h2>
        <p>Email: <b><?php echo $email; ?></b></p>

        <input type="text" id="search" placeholder="Search mail..." onkeyup="loadInbox()" />

        <div id="inbox"></div>

        <button class="btn" onclick="downloadInbox()">Download Emails</button>
        <a class="btn" href="index.php">New Email</a>
    </div>

<script>
setInterval(loadInbox, 4000);
window.onload = loadInbox;
</script>

</body>
</html>

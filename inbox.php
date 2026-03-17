<?php
$email = $_GET['email'] ?? "";
$filename = "mails/" . md5($email) . ".json";

$mails = [];
if (file_exists($filename)) {
    $mails = json_decode(file_get_contents($filename), true);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inbox - <?php echo $email; ?></title>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="refresh" content="10">
</head>
<body>
    <div class="box">
        <h2>Inbox: <?php echo $email; ?></h2>
        <a href="index.php" class="btn">Generate New Mail</a>

        <?php if (empty($mails)) { ?>
            <p>No mails yet. Waiting...</p>
        <?php } else { ?>
            <?php foreach ($mails as $mail) { ?>
                <div class="mail">
                    <h3><?php echo $mail['subject']; ?></h3>
                    <small>From: <?php echo $mail['from']; ?></small>
                    <p><?php echo nl2br($mail['message']); ?></p>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>

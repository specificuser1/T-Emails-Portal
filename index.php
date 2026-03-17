<?php
function generateEmail() {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $prefix = substr(str_shuffle($chars), 0, 8);
    $domains = ["tempmail.pk", "fakemail.me", "mytemp.ph"];
    $domain = $domains[array_rand($domains)];
    return $prefix . "@" . $domain;
}

$email = generateEmail();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Temp Mail Generator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
        <h1>Temp Mail Generator</h1>
        <div class="email-box">
            <input type="text" id="email" value="<?php echo $email; ?>" readonly>
            <button onclick="copyEmail()">Copy</button>
        </div>

        <a href="inbox.php?email=<?php echo $email; ?>" class="btn">Open Inbox</a>
    </div>

<script>
function copyEmail() {
    let field = document.getElementById("email");
    field.select();
    navigator.clipboard.writeText(field.value);
    alert("Copied: " + field.value);
}
</script>
</body>
</html>

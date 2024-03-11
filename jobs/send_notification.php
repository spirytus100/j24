<?php

require "/home/jovhmax/www/includes/config.php";
require "/home/jovhmax/www/includes/mymailer.php";

echo "Start\n";
$cursor = $conn->query("SELECT value FROM settings WHERE name = 'contact_mail'");
$result = $cursor->fetch_row();
$target_email = $result[0];
echo "Got contact mail address\n";

echo "Fetching tasks...\n";
$result = $conn->query("SELECT * FROM tasks WHERE finished = 0 AND scheduled_time >= CURRENT_DATE + INTERVAL 1 DAY AND scheduled_time < CURRENT_DATE + INTERVAL 2 DAY");
if (mysqli_num_rows($result) == 0) {
    exit("No due tasks");
}

echo "Preparing message...\n";
$msg = "";
$i = 0;
while ($row = $result->fetch_assoc()) {
    $time = $row["scheduled_time"];
    $category = ucfirst($row["category"]);
    $content = $row["content"];
    $line = "$time, $category: $content\n";
    $msg .= $line;
    $i += 1;
}

if ($i == 1) {
    $title = "Przypomnienie o jutrzejszym zadaniu: $content";
} else {
    $title = "Przypomnienie o jutrzejszych zadaniach";
}

echo "Sending message...\n";
$mailer = new MyMailer("ssl0.ovh.net");
$mailer->default_settings();
$mailer->send_mail("admin@xxx.ovh", $mail_passwd, $target_email, $title, $msg);
$conn->close();
exit("Mail sent");


?>
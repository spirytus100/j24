<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
$ph = password_hash("legia", PASSWORD_DEFAULT);
$conn->query("INSERT INTO users (username, password, email) VALUES ('j', '$ph', 'jw@abc.pl')");
$conn->close();
?>
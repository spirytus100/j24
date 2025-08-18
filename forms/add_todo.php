<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $task = $_POST["task"];
    $priority = $_POST["priority"];

    $stmt = $conn->prepare("INSERT INTO todo (task, priority) VALUES (?, ?)");
    $stmt->bind_param("si", $task, $priority);
    $stmt->execute();
    header("Location: /todo/");

} else {
    http_response_code(405);
}

?>
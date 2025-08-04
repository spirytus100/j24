<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $task = $_POST["task"];

    $stmt = $conn->prepare("INSERT INTO todo (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    header("Location: /todo/");

} else {
    http_response_code(405);
}

?>
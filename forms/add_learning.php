<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $learning_date = $_POST["learning_date"];
    $learning_time = $_POST["learning_time"];

    $stmt = $conn->prepare("INSERT INTO learning (learning_date, learning_time) VALUES (?, ? * 60)");
    $stmt->bind_param("si", $learning_date, $learning_time);
    $result = $stmt->execute();

    $conn->close();
    header("Location: /");

} else {
    http_response_code(405);
}

?>
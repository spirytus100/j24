<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $writing_date = $_POST["writing_date"];
    $writing_time = $_POST["writing_time"];

    $stmt = $conn->prepare("INSERT INTO writing (writing_date, writing_time) VALUES (?, ? * 60)");
    $stmt->bind_param("si", $writing_date, $writing_time);
    $result = $stmt->execute();

    $conn->close();
    header("Location: /");

} else {
    http_response_code(405);
}

?>
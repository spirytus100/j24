<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST["name"];
    $value = $_POST["value"];
    $id = $_POST["id"];

    $stmt = $conn->prepare("UPDATE cash SET name = ?, value = ? WHERE id = ?");
    $stmt->bind_param("sdi", $name, $value, $id);
    $stmt->execute();
    header("Location: /cash/");

} else {
    http_response_code(405);
}

?>
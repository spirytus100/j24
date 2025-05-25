<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $item = $_POST["item"];
    $category = $_POST["category"];
    $price = $_POST["price"];

    $stmt = $conn->prepare("INSERT INTO needs (name, category, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $item, $category, $price);
    $stmt->execute();
    header("Location: /needs/");

} else {
    http_response_code(405);
}

?>
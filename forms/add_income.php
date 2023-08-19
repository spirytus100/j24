<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $income_date = $_POST["income_date"];
    $value = $_POST["value"];

    $stmt = $conn->prepare("INSERT INTO income (income_date, asset, category, value) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $income_date, $name, $category, $value);
    $stmt->execute();
    $conn->close();
    header("Location: /income/");

}
?>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item = $_POST["item"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $expense_date = $_POST["expense_date"];
    $company = $_POST["company"];

    $stmt = $conn->prepare("INSERT INTO expenses (item, category, price, expense_date, company) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $item, $category, $price, $expense_date, $company);
    $result = $stmt->execute();

    $stmt = $conn->prepare("UPDATE budget SET real_cost = real_cost + ? WHERE category = ?");
    $stmt->bind_param("ds", $price, $category);
    $result = $stmt->execute();

    $conn->close();
    header("Location: /");

} else {
    http_response_code(405);
}
?>
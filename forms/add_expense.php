<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $item = $_POST["item"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $expense_date = $_POST["expense_date"];

    $stmt = $conn->prepare("INSERT INTO expenses (item, category, price, expense_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sids", $item, $category, $price, $expense_date);
    $result = $stmt->execute();

    $stmt = $conn->prepare("UPDATE budget SET real_cost = real_cost + ? WHERE category_id = ?");
    $stmt->bind_param("di", $price, $category_id);
    $result = $stmt->execute();

    $conn->close();
    header("Location: /expenses/");

} else {
    http_response_code(405);
}
?>
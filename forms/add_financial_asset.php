<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $buy_date = $_POST["buy_date"];
    $quantity = $_POST["quantity"];
    $buy_price = $_POST["buy_price"];
    $commission = $_POST["commission"];
    $currency = $_POST["currency"];
    if ($_POST["retirement"] == "true") {
        $retirement = true;
    } else {
        $retirement = false;
    }
    $active = true;

    $stmt = $conn->prepare("INSERT INTO financial_assets (name, category, buy_date, buy_quantity, buy_price, buy_commission, active, currency, retirement) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiddisi", $name, $category, $buy_date, $quantity, $buy_price, $commission, $active, $currency, $retirement);
    $stmt->execute();
    $conn->close();
    header("Location: /assets/");

}
?>
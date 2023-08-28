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
    $sell_date = $_POST["sell_date"];
    $sell_quantity = $_POST["sell_quantity"];
    $sell_price = $_POST["sell_price"];
    $sell_commission = $_POST["sell_commission"];
    if ($_POST["active"] == "true") {
        $active = true;
    } else {
        $active = false;
    }
    $id = $_POST["id"];

    $stmt = $conn->prepare("UPDATE financial_assets SET name = ?, category = ?, buy_date = ?, buy_quantity = ?, buy_price = ?, buy_commission = ?, sell_date = ?,
    sell_quantity = ?, sell_price = ?, sell_commission = ?, active = ?, currency = ?, retirement = ? WHERE id = ?");
    $stmt->bind_param("sssiddsiddisii", $name, $category, $buy_date, $quantity, $buy_price, $commission, $sell_date, $sell_quantity, $sell_price, $sell_commission, $active, $currency, $retirement, $id);
    $stmt->execute();
    $conn->close();
    header("Location: /assets/");

}
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT SUM(budget_cost), SUM(real_cost) FROM budget";
    $cursor = $conn->query($sql);
    $results = $cursor->fetch_row();

    $budget = $results[0];
    $real_cost = $results[1];
    $overspending = $budget - $real_cost;
    $month_year = date("m.Y");

    $stmt = $conn->prepare("INSERT INTO budget_results (month_year, budget, expenses, overspending) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sddd", $month_year, $budget, $real_cost, $overspending);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE budget SET budget_cost = 0.00, real_cost = 0.00, comments = NULL");
    $stmt->execute();
    header("Location: /budget/new");

}
?>
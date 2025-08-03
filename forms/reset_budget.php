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

    # zsumowane rezultaty budżetu
    $stmt = $conn->prepare("INSERT INTO budget_results (month_year, budget, expenses, overspending) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sddd", $month_year, $budget, $real_cost, $overspending);
    $stmt->execute();
    $stmt->close();

    # zapisanie rezultatów dla poszczególnych kategorii
    $stmt = $conn->prepare("INSERT INTO budget_results_expenses (month, year, category, budget_cost, real_cost) SELECT MONTH(CURRENT_DATE), YEAR(CURRENT_DATE), category, budget_cost, real_cost FROM budget");
    $stmt->execute();
    $stmt->close();

    # ustawienie kwot na zero w budżecie
    $stmt = $conn->prepare("UPDATE budget SET budget_cost = 0.00, real_cost = 0.00, comments = NULL");
    $stmt->execute();
    $stmt->close();

    # dopisanie wcześniej zidentyfikowanych potrzeb do nowego budżetu
    $categories = array();
    $result = $conn->query("SELECT name, category, price FROM needs");
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $category = $row["category"];
        $price = $row["price"];

        if (in_array($category, $categories) == true) {
            $conn->query("UPDATE budget SET budget_cost = budget_cost + $price, comments = CONCAT(comments, ', ', '$name') WHERE category = '$category'");
        } else {
            $conn->query("UPDATE budget SET budget_cost = $price, comments = '$name' WHERE category = '$category'");
        }
        array_push($categories, $category);
    }

    # dopisanie zsumowanej kwoty subskrypcji do nowego budżetu
    $cursor = $conn->query("SELECT CEIL(SUM(price)) FROM subscriptions WHERE frequency = 'miesiąc'");
    $result = $cursor->fetch_row();
    $subscriptions_price = $result[0];

    $conn->query("UPDATE budget SET budget_cost = $subscriptions_price WHERE category = 'rozrywka'");


    header("Location: /budget/new");

}
?>
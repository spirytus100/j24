<?php
require "/home/jovhmax/www/includes/config.php";

$result = $conn->query("SELECT * FROM subscriptions WHERE pay_day = DAY(CURRENT_DATE) AND frequency = 'miesiąc'");

if ($result->num_rows == 0) {
    echo "No subscriptions...<br>";

} else {
    while ($row = $result->fetch_assoc()) {

        $item = $row["name"];
        $price = $row["price"];
        $category = $row["category"];
        $expense_date = $row["pay_day"];
        $company = $row["company"];
        $frequency = $row["frequency"];

        $conn->query("INSERT INTO expenses (item, category, price, expense_date, company) VALUES ('$item', '$category', $price, CURRENT_DATE(), '$company')");

        $conn->query("UPDATE budget SET real_cost = real_cost + $price WHERE category = '$category'");

        echo "Subscription $item: $price zł saved to database<br>";
    }

    $conn->close();
    
}

?>
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/includes/MovingAverage.php";

use Dcvn\Math\Statistics as s;


function writing_data($conn) {
    $main_arr = array();
    $dates = array();
    $amounts = array();
    $result = $conn->query("SELECT writing_date, ROUND(SUM(writing_time)/60/60, 2) writing_time
    FROM writing
    WHERE writing_date BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 90 DAY) AND CURRENT_DATE GROUP BY writing_date ORDER BY writing_date");
    while ($row = $result->fetch_assoc()) {
        array_push($dates, $row["writing_date"]);
        array_push($amounts, $row["writing_time"]);
    }
    $main_arr["x"] = $dates;
    $main_arr["y"] = $amounts;
    $moving_average = new s\MovingAverage();
    $moving_average->setPeriod(7);
    $mavg = $moving_average->getCalculatedFromArray(array_map("floatval", $amounts));
    $main_arr["avg"] = $mavg;
    return $main_arr;
}

function writing_data_week($conn) {
    $main_arr = array();
    $dates = array();
    $amounts = array();
    $result = $conn->query("SELECT CONCAT(YEAR(writing_date), '/', WEEK(writing_date)) week, ROUND(SUM(writing_time)/60/60, 2) writing_time
    FROM writing
    WHERE YEAR(writing_date) = YEAR(CURRENT_DATE) OR YEAR(writing_date) = YEAR(CURRENT_DATE) - 1
    GROUP BY CONCAT(YEAR(writing_date), '/', WEEK(writing_date))");

    while ($row = $result->fetch_assoc()) {
        array_push($dates, $row["week"]);
        array_push($amounts, $row["writing_time"]);
    }
    $main_arr["x"] = $dates;
    $main_arr["y"] = $amounts;
    return $main_arr;
}

function writing_data_month($conn) {
    $main_arr = array();
    $dates = array();
    $amounts = array();
    $result = $conn->query("SELECT CONCAT(YEAR(writing_date), '-', MONTH(writing_date)) month, ROUND(SUM(writing_time)/60/60, 2) writing_time
    FROM writing
    WHERE YEAR(writing_date) = YEAR(CURRENT_DATE) OR YEAR(writing_date) = YEAR(CURRENT_DATE) - 1
    GROUP BY CONCAT(YEAR(writing_date), '-', MONTH(writing_date))");

    while ($row = $result->fetch_assoc()) {
        array_push($dates, $row["month"]);
        array_push($amounts, $row["writing_time"]);
    }
    $main_arr["x"] = $dates;
    $main_arr["y"] = $amounts;
    return $main_arr;
}

function assets_data($conn) {
    $main_arr = array();
    $categories = array();
    $values = array();
    $result = $conn->query("SELECT category, SUM(buy_quantity * buy_price + buy_commission) value
    FROM financial_assets WHERE active = 1 GROUP BY category");
    while ($row = $result->fetch_assoc()) {
        array_push($categories, $row["category"]);
        array_push($values, $row["value"]);
    }
    $main_arr["x"] = $categories;
    $main_arr["y"] = $values;
    return $main_arr;

}

function income_expenses($conn) {
    $main_arr = array();
    $months = array();
    $expenses = array();
    $income = array();
    $savings = array();

    $sql_expenses = "SELECT CONCAT(YEAR(expense_date), '-', MONTH(expense_date)) expenses_month, SUM(quantity * price) expenses_value
    FROM expenses
    WHERE expense_date BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 1 YEAR) AND CURRENT_DATE
    GROUP BY YEAR(expense_date), MONTH(expense_date)";

    $result = $conn->query($sql_expenses);
    while ($row = $result->fetch_assoc()) {
        array_push($months, $row["expenses_month"]);
        array_push($expenses, floatval($row["expenses_value"]));
    }

    $sql_income = "SELECT CONCAT(YEAR(income_date), '-', MONTH(income_date)) income_month, SUM(value) income_value
    FROM income
    WHERE income_date BETWEEN DATE_SUB(CURRENT_DATE, INTERVAL 1 YEAR) AND CURRENT_DATE
    GROUP BY YEAR(income_date), MONTH(income_date)";

    $result = $conn->query($sql_income);
    while ($row = $result->fetch_assoc()) {
        array_push($income, floatval($row["income_value"]));
    }

    for ($i = 0; $i < count($income); $i++) {
        array_push($savings, round($income[$i] - $expenses[$i], 2));
    }

    $main_arr["income"] = $income;
    $main_arr["expenses"] = $expenses;
    $main_arr["savings"] = $savings;
    $main_arr["months"] = $months;
    return $main_arr;

}

?>
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
    WHERE expense_date BETWEEN '2022-10-01' AND CURRENT_DATE
    GROUP BY YEAR(expense_date), MONTH(expense_date)";

    $result = $conn->query($sql_expenses);
    while ($row = $result->fetch_assoc()) {
        array_push($months, $row["expenses_month"]);
        array_push($expenses, floatval($row["expenses_value"]));
    }

    $sql_income = "SELECT CONCAT(YEAR(income_date), '-', MONTH(income_date)) income_month, SUM(value) income_value
    FROM income
    WHERE income_date BETWEEN '2022-10-01' AND CURRENT_DATE
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


function get_project_tasks($conn, $project_slug) {
    $tasks = array();
    $task_ids = array();
    $main_arr = array();

    # pobierz id projektu
    $sql = "SELECT id FROM projects WHERE slug = '$project_slug'";
    $result = $conn->query($sql);
    $value = $result->fetch_row();
    $project_id = $value[0];

    # pobierz id i nazwy podzadań
    $sql = "SELECT id, name FROM projects_tasks WHERE project_id = $project_id AND done = 0";
    $result = $conn->query($sql);

    # jeśli brak podzadań, odeślij pustą tablicę
    if (mysqli_num_rows($result) == 0) {
        $main_arr["found"] = false;
        return $main_arr;
    }

    while ($row = $result->fetch_assoc()) {
        $task_id = $row["id"];
        $task_name = $row["name"];
        array_push($tasks, $task_name);
        array_push($task_ids, $task_id);
    }
    $main_arr["found"] = true;
    $main_arr["task_ids"] = $task_ids;
    $main_arr["project_tasks"] = $tasks;
    return $main_arr;

}


function get_items_for_category($conn, $category) {
    $result = $conn->query("SELECT id FROM expense_categories where name = '$category'");
    $value = $result->fetch_row();
    $category_id = $value[0];

    $main_arr = array();
    $sub_arr = array();
    $result = $conn->query("SELECT name FROM expenses_items WHERE expense_categories_id = $category_id");
    while ($row = $result->fetch_assoc()) {
        $item = $row["name"];
        array_push($sub_arr, $item);
    }
    $main_arr["items"] = $sub_arr;
    return $main_arr;
}

?>
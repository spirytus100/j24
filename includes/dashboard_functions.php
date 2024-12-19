<?php

function format_money($number) {
    $money_str = (string) $number;

    if ($number < 1000) {
        return str_replace(".", ",", $money_str);
    } else if ($number >= 1000 && $number < 10000) {
        $first_part = substr($money_str, 0, 1);
    } else if ($number >= 10000 && $number < 100000) {
        $first_part = substr($money_str, 0, 2);
    } else if ($number >= 100000 && $number < 1000000) {
        $first_part = substr($money_str, 0, 3);
    }
   
    $last_part = substr($money_str, -6, 6);
    $last_part = str_replace(".", ",", $last_part);
    return "$first_part $last_part";
}

function get_total_writing($conn) {
    $sql = "SELECT round(sum(pta.time_spent)/60/60)
        FROM projects p 
        JOIN projects_tasks pt ON p.id=pt.project_id
        JOIN projects_tasks_activity pta ON pt.id=pta.task_id
        WHERE p.name = 'Pisanie'";
    $result = $conn->query($sql);
    $writing_time = $result->fetch_row();
    $writing_time = $writing_time[0];
    return $writing_time;
}

function get_writing_average($conn) {
    # zwraca średnią dzienną ilość czasu pisania w minutach
    
    $result = $conn->query("SELECT SUM(writing_time) / COUNT(DISTINCT(writing_date)) / 60 FROM `writing` WHERE id NOT IN (2, 3);");
    $writing_avg = $result->fetch_row();
    $avg_minutes = $writing_avg[0];
    return floor($avg_minutes);
}

function writing_left_to_mastery($conn) {
    $result = $conn->query("SELECT (10000 * 60 * 60 - SUM(writing_time)) / 60 FROM writing");
    $time_left = $result->fetch_row();

    $all_time_left_minutes = $time_left[0];
    $avg_minutes_in_day = get_writing_average($conn);

    $days_left = $all_time_left_minutes / $avg_minutes_in_day;

    $years = floor($days_left / 365);
    $days = floor($days_left - $years * 365);
    return "$years lat i $days dni";
}

function writing_time_spent($conn) {
    $result = $conn->query("SELECT COUNT(DISTINCT(writing_date)) + 400 FROM `writing`");
    $writing_days = $result->fetch_row();
    $writing_days = $writing_days[0];
    $years = floor($writing_days / 365);
    $days = $writing_days - $years * 365;
    return "$years lata i $days dni";
}

function get_total_read_books($conn) {
    $result = $conn->query("SELECT COUNT(*) FROM books WHERE finished IS NOT NULL");
    $total = $result->fetch_row();
    $total = $total[0];
    return $total;
}

function get_total_movies($conn) {
    $result = $conn->query("SELECT COUNT(*) FROM movies WHERE watched = 1");
    $total = $result->fetch_row();
    $total = $total[0];
    return $total;
}

function get_total_wealth($conn) {
    $sql = "
    SELECT ROUND(SUM(s.total), 2) AS total_money
    FROM (
        SELECT SUM((((financial_assets.buy_quantity) * financial_assets.buy_price) - financial_assets.buy_commission)) AS total
            FROM financial_assets
            WHERE (financial_assets.active = true)
        UNION
        SELECT SUM(cash.value) AS total
            FROM cash
        UNION
        SELECT c.value * er.rate AS total 
            FROM crypto c 
            JOIN exchange_rates er ON c.name = er.currency 
            WHERE er.currency = 'BTC' 
    ) s;";

    $result = $conn->query($sql);
    $total = $result->fetch_row();
    $total = $total[0];
    return $total;
}

function invested_assets_percent($conn) {
    $total_wealth = get_total_wealth($conn);
    $result = $conn->query("
    SELECT sum((((financial_assets.buy_quantity) * financial_assets.buy_price) - financial_assets.buy_commission)) AS total
    FROM financial_assets
    WHERE (financial_assets.active = true)");
    $total = $result->fetch_row();
    $total_invested = $total[0];
    $perc_invested = round($total_invested / $total_wealth * 100, 2);
    return $perc_invested;
}

function income_last_month($conn) {
    if (idate("m") != 1) {
        $sql = "SELECT SUM(value) FROM income WHERE MONTH(income_date) = MONTH(CURRENT_DATE) - 1 AND YEAR(income_date) = YEAR(CURRENT_DATE)";
    } else {
        $sql = "SELECT SUM(value) FROM income WHERE MONTH(income_date) = 12 AND YEAR(income_date) = YEAR(CURRENT_DATE) - 1";
    }
    $result = $conn->query($sql);
    $total = $result->fetch_row();
    $total = $total[0];
    return $total;
}

function last_month_spending($conn) {
    $sql = "SELECT expenses FROM budget_results WHERE id = (SELECT MAX(id) FROM budget_results)";
    $result = $conn->query($sql);
    $total = $result->fetch_row();
    $total = $total[0];
    return $total;
}

?>
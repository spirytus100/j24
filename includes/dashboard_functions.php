<?php

function format_money($number) {
    $money_str = (string) $number;

    if ($number < 1000) {
        return $money_str;
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
    $result = $conn->query("SELECT FLOOR(SUM(writing_time)/60/60) FROM writing");
    $writing_time = $result->fetch_row();
    $writing_time = $writing_time[0];
    return $writing_time;
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
    SELECT sum(s.total) AS total_money
    FROM (
        SELECT sum((((financial_assets.buy_quantity) * financial_assets.buy_price) - financial_assets.buy_commission)) AS total
            FROM financial_assets
            WHERE (financial_assets.active = true)
        UNION
        SELECT sum(cash.value) AS total
        FROM cash) s;";

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
    if (idate("m") != 12) {
        $sql = "SELECT SUM(value) FROM income WHERE MONTH(income_date) = MONTH(CURRENT_DATE) - 1";
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
<?php
#require "/home/jovhmax/www/includes/config.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

$sql = "
    SELECT ROUND(SUM(s.total), 2) AS total_money
    FROM (
        SELECT SUM((((financial_assets.buy_quantity) * financial_assets.buy_price) - financial_assets.buy_commission)) AS total
            FROM financial_assets
            WHERE (financial_assets.active = true) AND retirement = 0
        UNION
        SELECT SUM(cash.value) AS total
            FROM cash
            WHERE name NOT IN ('PPK', 'IKZE')
        UNION
        SELECT c.value * er.rate AS total 
            FROM crypto c 
            JOIN exchange_rates er ON c.name = er.currency 
            WHERE er.currency = 'BTC' 
    ) s;";

$result = $conn->query($sql);
$data = $result->fetch_row();
$current_wealth = $data[0];

echo "Got total wealth: $current_wealth<br>";

$conn->query("INSERT INTO wealth_increase (wealth_date, value) VALUES (CURRENT_DATE, $current_wealth)");
$conn->close();

exit("Succesfuly updated");

?>
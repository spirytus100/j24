<?php
require "/home/jovhmax/www/includes/config.php";

$fh = fopen("https://stat.gov.pl/download/gfx/portalinformacyjny/pl/defaultstronaopisowa/5239/1/1/rocznewskaznikicentowarowiuslugkonsumpcyjnychod1950roku.csv", "r");

while (($row = fgetcsv($fh, 1000, ";")) !== FALSE) {
    $year = $row[3];
    $inflation = floatval(str_replace(",", ".", $row[4]));

    $previous_year = date("Y") - 1;

    if ($year == "Rok") {
        continue;
    }

    if ($year == $previous_year) {
        $conn->query("INSERT INTO inflation_annual (year, inflation) VALUES ($year, $inflation)");
    }
}
fclose($fh);
$conn->close();
?>

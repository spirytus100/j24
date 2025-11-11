<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
/*
$ph = password_hash("legia", PASSWORD_DEFAULT);
$conn->query("INSERT INTO users (username, password, email) VALUES ('j', '$ph', 'xxx@xxx.com')");
$conn->close();
#echo var_dump(idate("m"));
*/
$fh = fopen("https://stat.gov.pl/download/gfx/portalinformacyjny/pl/defaultstronaopisowa/5239/1/1/rocznewskaznikicentowarowiuslugkonsumpcyjnychod1950roku.csv", "r");
while (($row = fgetcsv($fh, 1000, ";")) !== FALSE) {
    #echo($row[3] . " " . floatval(str_replace(",", ".", $row[4])));
    $year = $row[3];
    $inflation = floatval(str_replace(",", ".", $row[4]));

    if ($year == "Rok") {
        continue;
    }
    $conn->query("INSERT INTO inflation_annual (year, inflation) VALUES ($year, $inflation)");
}
fclose($fh);
$conn->close();

?>
<?php
require "/home/jovhmax/www/includes/config.php";

$result = $conn->query("SELECT 1 FROM writing WHERE writing_date = CURRENT_DATE");
if ($result->num_rows == 0) {
    echo "No writing today...<br>";
    echo "Inserting 0 to database<br>";
    $conn->query("INSERT INTO writing (writing_date, writing_time) VALUES (CURRENT_DATE, 0)");
    echo "Done";
}

?>
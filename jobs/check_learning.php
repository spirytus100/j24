<?php
require "/home/jovhmax/www/includes/config.php";

$result = $conn->query("SELECT 1 FROM learning WHERE learning_date = CURRENT_DATE");
if ($result->num_rows == 0) {
    echo "No learning today...<br>";
    echo "Inserting 0 to database<br>";
    $conn->query("INSERT INTO learning (learning_date, learning_time) VALUES (CURRENT_DATE, 0)");
    echo "Done";
}

?>
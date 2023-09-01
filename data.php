<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/chart_functions.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["type"])) {

        if ($_GET["type"] == "writing") {
            $data = writing_data($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "assets") {
            $data = assets_data($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "savings") {
            $data = income_expenses($conn);
            echo json_encode($data);
        }
    }
}
?>
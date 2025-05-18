<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/chart_functions.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["type"])) {

        if ($_GET["type"] == "writing" && !isset($_GET["group"])) {
            $data = writing_data($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "writing" && $_GET["group"] == "week") {
            $data = writing_data_week($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "writing" && $_GET["group"] == "month") {
            $data = writing_data_month($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "assets") {
            $data = assets_data($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "savings") {
            $data = income_expenses($conn);
            echo json_encode($data);

        } else if ($_GET["type"] == "expenses") {
            $category = $_GET["category"];
            $data = get_items_for_category($conn, $category);
            echo json_encode($data);

        } else if ($_GET["type"] == "activity") {
            $project_slug = $_GET["project"];
            $data = get_project_tasks($conn, $project_slug);
            echo json_encode($data);

        } else {
            http_response_code(422);
        }

    } else {
        http_response_code(422);
    }
    
} else {
    http_response_code(405);
}
?>
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["finished"]) && isset($_GET["id"])) {
   
        $finished = $_GET["finished"];
        $id = $_GET["id"];

        # end task
        if ($finished == "true") {
            $prepared_query = "UPDATE tasks SET finished = 1 WHERE id = ?";
        } else {
            $prepared_query = "DELETE FROM tasks WHERE id = ?";
        }

        $stmt = $conn->prepare($prepared_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        # if task is expense, insert expense, when task is finished

        # get task data
        if ($finished == "true") {
            $query = "SELECT category, content FROM tasks WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($task_category, $task_content);
            $stmt->fetch();
            $stmt->close();
        }

        $task_category = strtolower($task_category);

        if ($task_category != "płatności") {
            header("Location: /tasks/");
            die();
        }
        
        # match string and insert expense
        if (preg_match("#\d zł#", $task_content)) {
            $expense_data = explode(" ", $task_content);
            $item = $expense_data[0];
            $company = $expense_data[1];
            $price = str_replace(",", ".", $expense_data[2]);

            $stmt = $conn->prepare("INSERT INTO expenses (item, category, price, expense_date, company) VALUES (?, 'rachunki', ?, CURRENT_DATE(), ?)");
            $stmt->bind_param("sds", $item, $price, $company);
            $result = $stmt->execute();

            $stmt = $conn->prepare("UPDATE budget SET real_cost = real_cost + ? WHERE category = 'rachunki'");
            $stmt->bind_param("d", $price);
            $result = $stmt->execute();
        }

        $conn->close();
        header("Location: /tasks/");

    } else {
        http_response_code(422);
    }

} else {
    http_response_code(405);
}

?>
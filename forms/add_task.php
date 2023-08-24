<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["task_category"];
    $task_date = $_POST["task_date"];
    $content = $_POST["content"];

    if ($_POST["every-month"] == "true") {

        for ($i = 0; $i < 12; $i++) {
            $stmt = $conn->prepare("INSERT INTO tasks (scheduled_time, category, content) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $task_date, $category, $content);
            $stmt->execute();
            $task_date = date_create($task_date);
            date_add($task_date, date_interval_create_from_date_string("1 month"));
            $task_date = date_format($task_date, "Y-m-d H:i");
        }

        $conn->close();
        header("Location: /tasks/");
    }

    $stmt = $conn->prepare("INSERT INTO tasks (scheduled_time, category, content) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $task_date, $category, $content);
    $stmt->execute();
    $conn->close();
    header("Location: /tasks/");

}
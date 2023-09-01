<?php

include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["task_category"];
    $task_date = $_POST["task_date"];
    $content = $_POST["content"];
    $id = $_POST["id"];

    $stmt = $conn->prepare("UPDATE tasks set scheduled_time = ?, category = ?, content = ? WHERE id = ?");
    $stmt->bind_param("sssi", $task_date, $category, $content, $id);
    $stmt->execute();
    $conn->close();

    header("Location: /tasks/");

}

?>
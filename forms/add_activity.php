<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $task_id = $_POST["task_id"];
    $activity_date = $_POST["activity_date"];
    $activity_time_spent = intval($_POST["activity_time_spent"]) * 60;

    # wpis do tabeli zadań
    $stmt = $conn->prepare("INSERT INTO projects_tasks_activity (task_id, time_spent, activity_date) VALUES (?, ? , ?)");
    $stmt->bind_param("iis", $task_id, $activity_time_spent, $activity_date);
    $result = $stmt->execute();

    $conn->close();
    header("Location: /");

} else {
    http_response_code(405);
}

?>
<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["finished"]) && isset($_GET["id"])) {
   
        $finished = $_GET["finished"];
        $id = $_GET["id"];

        if ($finished == "true") {
            $prepared_query = "UPDATE tasks SET finished = 1 WHERE id = ?";
        } else {
            $prepared_query = "DELETE FROM tasks WHERE id = ?";
        }

        $stmt = $conn->prepare($prepared_query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: /tasks/");

    } else {
        http_response_code(422);
    }

} else {
    http_response_code(405);
}

?>
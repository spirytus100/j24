<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $key=>$val) {
        $sql = "UPDATE budget SET budget_cost = '$val' WHERE category = '$key'";
        $conn->query($sql);
    }
    header("Location: /budget/");

} else {
    http_response_code(405);
}
?>
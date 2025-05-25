<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["id"])) {
   
        $id = $_GET["id"];

        $query = "DELETE FROM needs WHERE id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("Location: /needs/");

    } else {
        http_response_code(422);
    }

} else {
    http_response_code(405);
}

?>
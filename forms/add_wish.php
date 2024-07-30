<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $item = $_POST["item"];

    $stmt = $conn->prepare("INSERT INTO wish_list (item) VALUES (?)");
    $stmt->bind_param("s", $item);
    $stmt->execute();
    header("Location: /wishlist/");

} else {
    http_response_code(405);
}

?>
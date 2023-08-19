<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title = $_POST["title"];
    $author = $_POST["author"];
    $published = $_POST["published"];
    if (isset($_POST["book_read"])) {
        $read = true;
        if (isset($_POST["finished"])) {
            $finished = $_POST["finished"];
        } else {
            $finished = null;
        }
    } else {
        $read = false;
        $finished = null;
    }
    $comments = $_POST["comments"];

    $stmt = $conn->prepare("INSERT INTO books (author, title, published, book_read, finished, comments) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $author, $title, $published, $read, $finished, $comments);
    $stmt->execute();
    header("Location: /books/");

} else {
    http_response_code(405);
}

?>
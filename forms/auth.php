<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($passwd_hash);
        $stmt->fetch();

        if (password_verify($password, $passwd_hash)) {
            $_SESSION['login'] = true;
            header("Location: /");
        } else {
            http_response_code(401);
        }

    } else {
        http_response_code(401);
    }

    $stmt->close();

} else {
    http_response_code(405);
}


?>
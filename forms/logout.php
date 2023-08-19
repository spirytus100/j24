<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION["login"])) {
        session_unset();
        session_destroy();
        header("Location: /");
    }
}
?>
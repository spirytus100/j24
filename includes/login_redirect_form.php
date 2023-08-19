<?php
session_start();
if (empty($_SESSION["login"]) && !isset($_SESSION["login"])) {
    header("Location: /login");
}
?>
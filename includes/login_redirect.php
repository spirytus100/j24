<?php
if (empty($_SESSION["login"]) && !isset($_SESSION["login"])) {
    header("Location: /login");
}
?>
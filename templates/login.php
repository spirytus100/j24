<!doctype html>
<html lang="pl">
<head>
<?php display_head("Logowanie", $elements); ?>
</head>
<body>
<?php
if (!empty($_SESSION["login"]) && isset($_SESSION["login"])) {
    header("Location: /");
}
?>
<div class="container mt-5">
    <div class="col">
        <h2 class="text-center mb-4">j24</h2>
        <form class="form-control" id="login-form" action="/forms/auth.php" method="post">
            <label class="form-label" for="username"><b>Nazwa użytkownika</b></label>
            <input class="form-control" type="text" name="username" required><br>

            <label class="form-label" for="password"><b>Hasło</b></label>
            <input class="form-control" type="password" name="password" autocomplete="on" required><br>

            <button class="btn btn-primary" type="submit" form="login-form">Zaloguj się</button>
        </form>
    </div>
</div>
</body>
</html>
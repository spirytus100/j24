<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title = $_POST["title"];
    $prod_year = $_POST["prod_year"];
    $genre = $_POST["genre"];
    $production = $_POST["production"];

    if (isset($_POST["movie_watched"])) {
        $watched = true;
        if (isset($_POST["watch_date"])) {
            $watch_date = $_POST["watch_date"];
        } else {
            $watch_date = null;
        }
    } else {
        $watched = false;
        $watch_date = null;
    }

    if (isset($_POST["rating"])) {
        $rating = $_POST["rating"];
    } else {
        $rating = null;
    }

    $stmt = $conn->prepare("INSERT INTO movies (title, prod_year, genre, production, watched, watch_date, rating) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissisi", $title, $prod_year, $genre, $production, $watched, $watch_date, $rating);
    $stmt->execute();
    header("Location: /movies/");

} else {
    http_response_code(405);
}

?>
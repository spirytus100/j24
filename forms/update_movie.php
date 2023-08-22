<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title = $_POST["title"];
    $prod_year = $_POST["prod_year"];
    $genre = $_POST["genre"];

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

    $id = $_POST["id"];

    $stmt = $conn->prepare("UPDATE movies SET title = ?, prod_year = ?, genre = ?, watched = ?, watch_date = ?, rating = ? WHERE id = ?");
    $stmt->bind_param("sisisii", $title, $prod_year, $genre, $watched, $watch_date, $rating, $id);
    $stmt->execute();
    header("Location: /movies/");

} else {
    http_response_code(405);
}

?>
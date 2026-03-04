<?php
include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect_form.php";
include $_SERVER["DOCUMENT_ROOT"]."/includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $rssName = $_POST["rss_name"];
    $rssUrl = $_POST["rss_url"];

    $error = false;

    // sprawdzenie, czy URL jest prawidłowy
    if (!filter_var($rssUrl, FILTER_VALIDATE_URL)) {
        $error = true;
    }

    $ch = curl_init($rssUrl);

    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

    curl_exec($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

    if ($httpCode >= 200 && $httpCode < 300) {
        $error = false;
    } else {
        $error = true;
    }

    if ($error === true) {
        echo "Podany URL jest błędny.";
        die();
    }

    try {
        $stmt = $conn->prepare("INSERT INTO rss_sources (name, url) VALUES (?, ?)");
        $stmt->bind_param("ss", $rssName, $rssUrl);
        $stmt->execute();

    } catch (mysqli_sql_exception $e) {
        echo "Wystąpił błąd bazy danych: " . $e->getMessage();
        die();
    }

    header("Location: /rss_reader/");
    exit();

} else {
    http_response_code(405);
    exit();
}

?>
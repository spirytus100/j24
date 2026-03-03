<?php

require "/home/jovhmax/www/includes/config.php";


$result = $conn->query("SELECT name, url FROM rss_sources");

$feeds = array();

while ($row = $result->fetch_assoc()) {
    $feeds[$row["name"]] = $row["url"];
}

foreach ($feeds as $sourceName => $url) {
    
    // Ustawiamy timeout, żeby skrypt nie wisiał, jak źródło nie odpowiada
    $context = stream_context_create([
        'http' => ['timeout' => 5] // 5 sekund na źródło max
    ]);

    // Pobieramy treść XML
    $xmlContent = @file_get_contents($url, false, $context);
    
    if (!$xmlContent) {
        continue; // Jeśli błąd, idź do następnego źródła
    }

    $rss = @simplexml_load_string($xmlContent);
    if (!$rss) {
        continue;
    }

    $count = 0;
    foreach ($rss->channel->item as $item) {
        if ($count >= 10) break; // Pobierz max 10 najnowszych z każdego źródła

        $title = (string)$item->title;
        $link  = (string)$item->link;
        $dateStr = (string)$item->pubDate;

        $title = substr($title, 0, 250);
        
        // Konwersja daty na format MySQL (Y-m-d H:i:s)
        $dateObj = date_create($dateStr);
        if (!$dateObj) {
            $dateObj = new DateTime(); // Fallback na teraz
        }
        $formattedDate = date_format($dateObj, 'Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT IGNORE INTO rss_news (source_name, title, link, pub_date) 
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $sourceName, $title, $link, $formattedDate);
        $stmt->execute();
        
        $count++;
    }
}

// Żeby tabela nie rosła w nieskończoność, usuń wpisy starsze niż 30 dni
$conn->query("DELETE FROM rss_news WHERE pub_date < NOW() - INTERVAL 30 DAY");
$conn->close();

echo "Zakończono import.";

?>
<?php

require "/home/jovhmax/www/includes/config.php";

$result = $conn->query("SELECT value FROM settings WHERE name = 'freecurrencyapi_apikey'");
$value = $result->fetch_row();
$apikey = $value[0];

$currencies = array("USD", "EUR");

foreach ($currencies as $currency) {
    $url = "https://api.freecurrencyapi.com/v1/latest?base_currency=$currency&currencies=PLN";

    $resource = curl_init($url);

    curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($resource, CURLOPT_HTTPHEADER, array("apikey: $apikey", "Content-Type: application/json", "Accept: application/json"));
    $result = curl_exec($resource);
    echo "Request sent to $url<br>";
    $info = curl_getinfo($resource);
    $code = curl_getinfo($resource, CURLINFO_HTTP_CODE);
    echo "Return code $code<br>";
    if ($code != 200) {
        echo $info . "<br>";
    }

    $response = json_decode($result);
    $exchange_rate = round($response->data->PLN, 2);

    $conn->query("UPDATE exchange_rates SET rate = $exchange_rate, updated_at = NOW() WHERE currency = '$currency'");

    echo "Got exchange rate, $currency: $exchange_rate<br>";

    sleep(5);
}

$conn->close();

?>
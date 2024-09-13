<?php

require "/home/jovhmax/www/includes/config.php";

$result = $conn->query("SELECT value FROM settings WHERE name = 'coingecko_apikey'");
$value = $result->fetch_row();
$apikey = $value[0];

# get bitcoin price
$url = 'https://api.coingecko.com/api/v3/coins/bitcoin';

$resource = curl_init($url);

curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
curl_setopt($resource, CURLOPT_HTTPHEADER, array("x-cg-demo-api-key: $apikey", "Content-Type: application/json", "Accept: application/json"));
$result = curl_exec($resource);
echo "Request sent to $url<br>";
$info = curl_getinfo($resource);
$code = curl_getinfo($resource, CURLINFO_HTTP_CODE);
echo "Return code $code<br>";
if ($code != 200) {
    echo $info . "<br>";
}


$resp = json_decode($result);
$btc_rate = round($resp->market_data->current_price->pln, 2);

curl_close($resource);

$conn->query("UPDATE exchange_rates SET rate = $btc_rate, updated_at = NOW() WHERE currency = 'BTC'");
echo "Table updated with BTC price = $btc_rate<br>";

$conn->close();

?>
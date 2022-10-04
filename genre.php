<?php

$curl = curl_init();
if (!empty($_REQUEST['genre'])) {
    $genre = $_REQUEST['genre'];
}
curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/v2/get-popular-movies-by-genre?genre=$genre&limit=100",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: imdb8.p.rapidapi.com",
        "X-RapidAPI-Key: 79b7873b36msh62aa8f43e09c756p1adf2ejsnfb16dc246642"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response);
    foreach ($data as $value) {
?>
    <?php
    }
}
<!-- <pre> -->
<?php
include('./common/header.php');
include('./common/links.php');
if (!empty($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-overview-details?tconst=$id",
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
    // print_r($data);
?>
    <div class="container-fluid content">
        <div class="col-md-4 infoo">
            <img src="<?php echo $data->title->image->url ?>" class="img-fluid" />
        </div>
        <div class="col-md-7 infoo">
            <h2><?php echo (!empty($data->title->title)) ? ($data->title->title) : ("No data found") ?></h2>
            <p><b>Type: </b><?php echo (!empty($data->title->titleType)) ? ($data->title->titleType) : ("No data found") ?></p>
            <p><b>Rating: </b><?php echo (!empty($data->ratings->rating)) ? ($data->ratings->rating) : ("No data found") ?></p>
            <p><b>Genres</b></p>
            <ul>
                <?php
                foreach ($data->genres as $genres => $gendata) {
                ?>
                    <li><?php echo (!empty($gendata)) ? ($gendata) : ("No data found") ?></li>
                <?php
                }
                ?>
            </ul>
            <p><b>Release Date: </b><?php echo (!empty($data->releaseDate)) ? ($data->releaseDate) : ("No data found") ?></p>
            <p><b>OverView: </b><?php echo (!empty($data->plotSummary->text)) ? ($data->plotSummary->text) : ("No data Founf") ?></p>
        </div>
    </div>
<?php
}

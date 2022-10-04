<?php
include('./common/header.php');
include('./common/links.php');
if (!empty($_REQUEST['search'])) {
  $sname = $_REQUEST['search'];
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=$sname",
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
} else {
  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q='i'",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 100,
    CURLOPT_TIMEOUT => 100,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "X-RapidAPI-Host: imdb8.p.rapidapi.com",
      "X-RapidAPI-Key: 79b7873b36msh62aa8f43e09c756p1adf2ejsnfb16dc246642"

    ],
  ]);
}
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data = json_decode($response);
?>
  <div class="container-fluid content">
    <div class="container d-flex justify-content-evenly flex-wrap">
      <?php
      foreach ($data->d as $one => $d) {
        if (!empty($d->i->imageUrl)) {

      ?>
          <a href="info.php?id=<?php echo $d->id ?> " class="info">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="<?php if (!empty($d->i->imageUrl)) echo ($d->i->imageUrl) ?>" alt="image url broken" />
              <div class="card-body">
                <h5 class="card-title"><?php if (!empty($d->l)) print_r($d->l) ?></h5>
                <p class="card-text">Type: <?php if (!empty($d->q)) print_r($d->q) ?></p>
              </div>
            </div>
          </a>
      <?php
        }
      }
      ?>

    </div>
  <?php
}
  ?>
  </div>
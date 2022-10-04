<!-- header starts here -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid d-flex justify-content-between">
        <!-- logo -->
        <a class="navbar-brand" href="index.php"><img id="MDB-logo" src="./images/logo.png" alt="MDB Logo" draggable="false" height="30" /></a>
        <!-- logo -->

        <!-- items -->
        <ul class="nav-item navigations">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-3" href="index.php">
                    <i class="fas fa-home pe-2"></i>Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-3" href="#">
                    Movies
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-3" href="#">
                    Shows
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-3" href="#">
                    Web series
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center me-3" href="#">
                    Popular
                </a>
            </li>
        </ul>
        <!-- items -->

        <!-- search starts here -->
        <form class="d-flex align-items-center w-50 form-search" action="index.php">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="Search" aria-label="Search" name="search" />
            </div>
            <a href="#!" class="text-white"><i class="fas fa-search ps-3"></i></a>
        </form>
        <!-- search ends here -->
</nav>
<!-- genres starts here -->
<div class="container-fluid">
    <ul class="genres">
        <?php

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/list-popular-genres",
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
        ?>

            <div class="dropdown container-fluid text-center">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Filter By Genres
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                    foreach ($data->genres as $genre => $data) {
                    ?>
                        <li><a role=" button" class="btn btn-dark dropdown-item g-item"><?php echo $data->description ?></a></li>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </ul>
</div>
<!-- genres ends here -->
<!-- header ends here -->
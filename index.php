<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Weather Forecast</title>
</head>

<body>
    <?php require "services/WeatherService.php"?>

	<div class="container mx-auto my-5 col-10">
		<form class="row g-3" method="get">
			<div class="col-auto">
		    <label for="staticEmail2" class="visually-hidden">Post Code</label>
		    <input type="text" readonly class="form-control-plaintext h5" id="staticEmail2" value="Post Code">
		  </div>
		  <div class="col-auto">
		    <label for="inputPassword2" class="visually-hidden">Post Code</label>
		    <input type="text" class="form-control" id="postCode" name="postCode" placeholder="Post Code">
				<span class="text-danger"><?php echo $errPostCode ?></span>
		  </div>
		  <div class="col-auto">
		    <button type="submit" class="btn btn-primary mb-3 px-5">Submit</button>
		  </div>
		</form>

        <?php if(isset($coords) && isset($weather)) : ?>
            <div class="row mt-3">
                <h1><?php echo strtok($postCodeDetail->adminName1, " ") . ", " . $postCodeDetail->placeName . " City, " . str_replace(' ', '-', $postCodeDetail->adminName2) ; ?></h1>
                <h5>3-day forecast</h5>
            </div>

            <div class="row">
                <?php foreach ($weather->daily as $item) :
                    $iconUrl = "https://openweathermap.org/img/w/" . $item->weather[0]->icon . ".png"
                ?>
                    <div class='col-4 g-3'>
                        <div class='card border'>
                            <img class='card-img-top w-25 m-auto' src=<?php echo $iconUrl; ?> alt='Card image cap'>
                            <div class='card-body'>
                                <div class='row'>
                                    <div class='col-6'><?php echo gmdate("Y-m-d", $item->dt) ?></div>
                                    <div class='col-6 text-end'><?php echo gmdate("D", $item->dt) ?></div>
                                </div>
                                <h5 class='my-2 text-capitalize text-center'><?php echo $item->weather[0]->description;  ?></h5>
                                <div class='row'>
                                    <div class='col-6'>Max: <?php echo $item->temp->max; ?>&deg;</div>
                                    <div class='col-6 text-end'>Min: <?php echo $item->temp->min; ?>&deg;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row mt-3">
                <h5>Map</h5>
            </div>

            <div class="row g-3">
                <div class="col-6">
                    <div class="card border">
                        <div id="map" style="width:100%;height:400px;"></div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card border">
                        <?php $icon2Url = "https://openweathermap.org/img/w/" . $currentWeatherDetail->icon . ".png" ?>
                        <img class='card-img-top w-25' src=<?php echo $icon2Url; ?>  alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize"><?php echo $currentWeatherDetail->temp; ?>&deg; </h5>
                            <span class="text-muted">feels like <?php echo $currentWeatherDetail->feels_like; ?>&deg;</span>
                            <p>Current Weather in <?php echo strtok($postCodeDetail->adminName1, " ") . ", " . $postCodeDetail->placeName . " City, " . str_replace(' ', '-', $postCodeDetail->adminName2) ; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function initMap() {
            const place = { lat: <?php echo $postCodeDetail->lat; ?>, lng: <?php echo $postCodeDetail->lng; ?> };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: place,
            });
            const marker = new google.maps.Marker({
                position: place,
                map: map,
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC786SJQV6ht9RBt04LXfftNd6ZjY6w60o&callback=initMap&libraries=&v=weekly&channel=2" async></script>

</body>
</html>

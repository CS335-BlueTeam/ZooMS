<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        .report-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    </style>
    <title>Zoo Weather</title>
</head>
    <body>
        <?php
        $apiKey = "8319139fb9edf73b366bdadd9adbfbad";
        $cityId = "5110253";
        $weatherApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
        
        // curl session
        $ch = curl_init();

        // options for curl
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $weatherApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // response object
        $response = curl_exec($ch);

        // close curl session
        curl_close($ch);
        // decode json
        $data = json_decode($response);

        // set our timezone and get current time
        date_default_timezone_set('America/New_York');
        $currentTime = time();

		echo file_get_contents("../html/header.php");
        ?>
        <div id="w-banner">
        </div>
        <div class="report-container">
            <h2 id='w-head'>Today's Weather at the Zoo</h2>
            <h5><?php echo $data->name; ?> Weather Status</h2>
            <div class="time">
                <div><?php echo date("l g:i a", $currentTime); ?></div>
                <div><?php echo date("jS F, Y",$currentTime); ?></div>
                <div><?php echo ucwords($data->weather[0]->description); ?></div>
            </div>
            <div class="weather-forecast">
                <img
                    src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                    class="weather-icon" /> 
                    <table>
                        <tr>
                            <th>
                                High
                            </th>
                            <th>
                                Low
                            </th>
                        </tr>
                        <tr>
                            <td id='max-temp'>
                                <?php echo $data->main->temp_max; ?>°C
                            </td>
                            <td id='min-temp'>
                                <?php echo $data->main->temp_min; ?>°C
                            </td>
                        </tr>
                    </table>
            </div>
            <div class="weather-more">
                <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
                <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
            </div>
        </div>
    </body>
</html>
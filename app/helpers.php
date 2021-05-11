<?php

//Print array / object - Mahadev
function pd($data, $die = true) {
    echo "<pre>";
    print_r($data);
    if ($die) {
        die;
    }
}

function calculateAge($birthDate) {

    $date = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

function formateDate($date, $format = false) {
    if ($date) {
        if ($format) {
            return date($format, strtotime($date));
        } else {
            return date('m/d/Y', $date);
        }
    } else {
        return "";
    }
}

function getFileNameFromFilePath($file) {

    $fileName = pathinfo($file, PATHINFO_FILENAME);
    $fileName = ltrim($fileName, '0');
    return $fileName;
}

function calculatePercentage($oldPrice, $newPrice) {

    $percentChange = ($newPrice / $oldPrice) * 100;

    return number_format(abs($percentChange), 2);
}

function calculateZones($x, $y) {

    $x1 = number_format((float) ($x / 3), 2, '.', '');
    $y1 = number_format((float) ($y / 2), 2, '.', '');

    $zones = [];

    $zones['a1']['x'] = $x1;
    $zones['a1']['y'] = $y1;

    $zones['a2']['x'] = $x1;
    $zones['a2']['y'] = $y;

    $zones['b1']['x'] = $x1 + $x1;
    $zones['b1']['y'] = $y1;

    $zones['b2']['x'] = $x1 + $x1;
    $zones['b2']['y'] = $y;

    $zones['c1']['x'] = $x;
    $zones['c1']['y'] = $y1;

    $zones['c2']['x'] = $x;
    $zones['c2']['y'] = $y;

    return $zones;
}

function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
    
    $theta = $longitude1 - $longitude2;
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $distance = acos($distance);
    $distance = rad2deg($distance);
    $distance = $distance * 60 * 1.1515;
    
    switch ($unit) {
        case 'miles':
            break;
        case 'kilometers' :
            $distance = $distance * 1.609344;
        case 'meters' :
            $distance = $distance * 1609.34;
    }
    return (round($distance, 2));
}

function getTimeIntervals(){
    
    $interval[0] = '0-5';
    $interval[1] = '5-10';
    $interval[2] = '10-15';
    $interval[3] = '15-20';
    $interval[4] = '20-25';
    $interval[5] = '25-30';
    $interval[6] = '30-35';
    $interval[7] = '35-40';
    $interval[8] = '45-50';
    $interval[9] = '55-60';
    $interval[9] = '65-70';
    $interval[9] = '70-75';
    $interval[9] = '75-80';
    
    return $interval;
}
?>

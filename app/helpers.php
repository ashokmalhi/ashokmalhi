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

?>

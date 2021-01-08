<?php

//Print array / object - Mahadev
function pd($data, $die = true)
{
    echo "<pre>";
    print_r($data);
    if ($die) {
        die;
    }
}

?>

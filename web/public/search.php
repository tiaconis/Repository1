<?php

    require(__DIR__ . "/../includes/config.php");

    // numerically indexed array of places
    $places = [];
    
    // ensure proper usage
    if (empty($_GET["geo"]))
    {
        http_response_code(400);
        exit;
    }
    
    // search database for matching places using most likely fields (postal, city, state, state-abbrev.
    $places_returned = query("SELECT * FROM places WHERE MATCH(postal_code, place_name, admin_name1, admin_code1) AGAINST (? IN NATURAL LANGUAGE MODE)", $_GET["geo"]);
          
    if (count($places_returned) >= 1)
    {
        // iterate over places
        foreach ($places_returned as $place)
        {
            // add place to array
            $places[] = [
                "city" => $place["place_name"],
                "state" => $place["admin_name1"],
                "postal_code" => $place["postal_code"],
                "latitude" => $place["latitude"],
                "longitude" => $place["longitude"]
            ];
        }
    }
        
    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($places, JSON_PRETTY_PRINT));

?>

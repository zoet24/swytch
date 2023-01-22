<?php
/**
 * Template Name: Popular accessories
 * Description: A page template to show the most popular accessories.
 */

$context = Timber::context();

// Query Swytch API with variables from .env to output accessories_data
function get_accessories_api() {
    $api_user = API_USER;
    $api_key = API_KEY;
    $credentials = base64_encode($api_user.':'.$api_key);
    $url = 'https://swytchbike.com/wp-json/swytch/v1/dev';

    $options = array(
        'http' => array(
            'header' => "Authorization: Basic $credentials"
        )
    );
    $context = stream_context_create($options);
    $data = file_get_contents($url, false, $context);

    return json_decode($data);
}

$accessories_data = get_accessories_api()->data;

// Add name, sold and price (GBP) of each accessory to accessories array
$accessories = [];

foreach ($accessories_data as $accessory_data) {
    $accessory = [
        'name' => $accessory_data->name,
        'sold' => $accessory_data->sold,
        'price' => $accessory_data->price->GBP
    ];
    array_push($accessories, $accessory);
}

// Sort accessories array by descending sold value and store the 50 most popular accessories
function sortBySold($a, $b) {
    return $b['sold'] - $a['sold'];
}

usort($accessories, 'sortBySold');
$accessories_fifty = array_slice($accessories, 0, 50);

$context["accessories"] = $accessories_fifty;

Timber::render( 'popular-accessories.twig', $context );
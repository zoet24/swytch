<?php
/**
 * Template Name: Popular accessories
 * Description: A page template to show the most popular accessories.
 */

$context = Timber::context();

// Query Swytch API with variables from .env
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

// Store first 50 popular accessories
$accessories_data = array_slice((get_accessories_api()->data), 0, 50);

// Cycle through 50 accessories and add data to accessories array
$accessories = [];

foreach ($accessories_data as $accessory_data) {
    $accessory = [
        'name' => $accessory_data->name,
        'sold' => $accessory_data->sold,
        'price' => $accessory_data->price->GBP
    ];
    array_push($accessories, $accessory);
}

$context["accessories"] = $accessories;

Timber::render( 'popular-accessories.twig', $context );
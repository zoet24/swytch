<?php
/**
 * Template Name: Popular accessories
 * Description: A page template to show the most popular accessories.
 */

$context = Timber::context();

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
$accessories = [];

// var_dump($accessories_data);

foreach ($accessories_data as $accessory_data) {
    // var_dump($accessory_data->price->EUR);

    $accessory = [
        'name' => $accessory_data->name,
        'sold' => $accessory_data->sold,
        'price' => $accessory_data->price->GBP
    ];
    array_push($accessories, $accessory);
}

$context["accessories"] = array_slice($accessories, 0, 50);
// var_dump($context["accessories"]);

Timber::render( 'popular-accessories.twig', $context );
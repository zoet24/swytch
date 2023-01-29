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
    $discount = ($accessory_data->price->GBP->regular) - ($accessory_data->price->GBP->sale);

    $accessory = [
        'name' => $accessory_data->name,
        'sold' => $accessory_data->sold,
        'price' => $accessory_data->price->GBP,
        'disc' => $discount
    ];
    array_push($accessories, $accessory);
}

// Set sort by popularity as default
usort($accessories, function ($a, $b) {
    return $b['sold'] - $a['sold'];
});

$sort = $_GET['sort'];
if ($sort == 'name_asc') {
    usort($accessories, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });
} elseif ($sort == 'name_desc') {
    usort($accessories, function ($a, $b) {
        return strcmp($b['name'], $a['name']);
    });
} elseif ($sort == 'sold_desc') {
    usort($accessories, function ($a, $b) {
        return $b['sold'] - $a['sold'];
    });
} elseif ($sort == 'disc_desc') {
    usort($accessories, function ($a, $b) {
        return $b['disc'] - $a['disc'];
    });
}

$accessories_fifty = array_slice($accessories, 0, 50);

$context["accessories"] = $accessories_fifty;
$context['sort'] = $sort;

Timber::render( 'popular-accessories.twig', $context );
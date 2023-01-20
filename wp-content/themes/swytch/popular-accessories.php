<?php
/**
 * Template Name: Popular accessories
 * Description: A page template to show the most popular accessories.
 */

$context = Timber::context();

function get_accessories() {
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

$accessories = get_accessories();

Timber::render( 'popular-accessories.twig', $context );
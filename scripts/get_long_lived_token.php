<?php
// Cara tukar short-lived token ke long-lived token
// Pastikan isi .env dengan APP_ID, APP_SECRET, dan SHORT_LIVED_TOKEN

$endpoint = 'https://graph.facebook.com/v22.0/oauth/access_token';
$params = [
    'grant_type' => 'fb_exchange_token',
    'client_id' => env('META_APP_ID'),
    'client_secret' => env('META_APP_SECRET'),
    'fb_exchange_token' => env('META_SHORT_LIVED_TOKEN'),
];

$response = \Illuminate\Support\Facades\Http::get($endpoint, $params);
$longLivedToken = $response->json();

dd($longLivedToken); // Copy access_token hasil ini ke .env untuk WhatsApp Business API

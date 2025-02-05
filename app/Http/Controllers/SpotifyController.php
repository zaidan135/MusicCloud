<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class SpotifyController extends Controller
{
    private $client;
    private $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = $this->getAccessToken();
    }

    private function getAccessToken()
    {
        $response = $this->client->post('https://accounts.spotify.com/api/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('SPOTIFY_CLIENT_ID'),
                'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
            ],
        ]);

        return json_decode($response->getBody(), true)['access_token'];
    }

    public function getMusicByGenre($genre)
    {
        $response = $this->client->get("https://api.spotify.com/v1/search", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'query' => [
                'q' => $genre,
                'type' => 'track',
                'limit' => 10,
            ],
        ]);

        $tracks = json_decode($response->getBody(), true)['tracks']['items'];

        return view('music.spotify', compact('tracks', 'genre'));
    }
}

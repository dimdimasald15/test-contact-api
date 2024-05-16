<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $urlApi = "http://127.0.0.1:8000/api/";

    public function getUrl($url, $token)
    {
        $client = new Client();
        $response = $client->get($url, [
            'headers' => [
                'Authorization' => $token,
            ],
        ]);

        $content = (string) $response->getBody();
        return $content;
    }
}

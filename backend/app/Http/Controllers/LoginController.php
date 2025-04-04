<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController
{
    public function login()
    {
        $code = request()->get('code');

        $response = Http::post('https://auth.huggy.app/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => config('services.huggy.client_id'),
            'client_secret' => config('services.huggy.client_secret'),
            'redirect_uri' => config('services.huggy.redirect_url'),
            'code' => $code,
        ]);
    

        $accessToken = $response->json()['access_token'];
        $refreshToken = $response->json()['refresh_token'];
    
        return response()->json(['success' => true]);
    }
}

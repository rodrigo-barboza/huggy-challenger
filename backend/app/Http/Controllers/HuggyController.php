<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class HuggyController
{
    public function __invoke()
    {
        $auth_url = "https://auth.huggy.app/oauth/authorize?scope=install_app%20read_agent_profile&response_type=code&redirect_uri={callback_url}&client_id={client_id}";
        $url = Str::of($auth_url)
            ->replace('{callback_url}', config('services.huggy.redirect_url'))
            ->replace('{client_id}', config('services.huggy.client_id'));

        return redirect()->away($url);
    }
}

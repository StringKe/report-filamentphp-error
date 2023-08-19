<?php

namespace App\Http\Controllers\Company;

class OAuthController
{
    public function redirect($provider)
    {
        return $provider;
    }

    public function callback($provider)
    {
        return $provider;
    }
}

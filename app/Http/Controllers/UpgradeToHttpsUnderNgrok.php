<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class UpgradeToHttpsUnderNgrok extends Controller
{
    public function handle(Request $request, Closure $next): Response
    {
        if(str_ends_with($request->getHost(), '.ngrok-free.app')) {
            URL::forceScheme('https');
        }

        return $next($request);
    }
}

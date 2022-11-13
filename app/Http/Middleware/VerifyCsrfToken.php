<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        'http://127.0.0.1:8000/api/instagram/hashtag',
        'http://127.0.0.1:8000/api/instagram/event',
        'http://127.0.0.1:8000/api/instagram/users/register',
        'http://127.0.0.1:8000/api/instagram/users/login',
        'http://127.0.0.1:8000/api/instagram/event/*',
    ];
}

<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'employees/*',
        'projectGroups/*',
        'companies/*',
        'candidates/*',
        'results/*',
        'interests/*',
        'fields/*',
        'messages/*',
        'likes/*',
        'resumes/*',
        'tasks/*',
        'events/*',
        'dashboard/*'
    ];
}

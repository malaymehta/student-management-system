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
        'students/ajax/imageDelete',
        'batches/ajax/imageDelete',
        'sections/ajax/getBatch',
        'students/ajax/getBatch',
        'students/ajax/getSection',
        'profile/ajax/imageUpload',
        'profile/ajax/imageDelete'
    ];
}

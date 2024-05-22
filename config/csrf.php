<?php
return [
    'disable_csrf_check' => env('DISABLE_CSRF_CHECK', false),
    'token_length' => env('CSRF_TOKEN_LENGTH', 64),
];

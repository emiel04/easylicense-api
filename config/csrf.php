<?php
return [
    'enable_header_auth' => env('ENABLE_HEADER_AUTH_WITHOUT_CSRF_CHECK', false),
    'token_length' => env('CSRF_TOKEN_LENGTH', 64),
];

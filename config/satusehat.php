<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SATUSEHAT Environment & Credentials
    |--------------------------------------------------------------------------
    */
    'env' => env('SATUSEHAT_ENV', 'staging'), // 'staging' or 'production'

    'auth_url' => env(
        'SATUSEHAT_AUTH_URL',
        env('SATUSEHAT_ENV', 'staging') === 'production'
            ? 'https://api-satusehat.kemkes.go.id/oauth2/v1'
            : 'https://api-satusehat-stg.dto.kemkes.go.id/oauth2/v1'
    ),

    'base_url' => env(
        'SATUSEHAT_BASE_URL',
        env('SATUSEHAT_ENV', 'staging') === 'production'
            ? 'https://api-satusehat.kemkes.go.id/ssrme/v2'
            : 'https://api-satusehat-stg.dto.kemkes.go.id/ssrme/v2'
    ),

    'fhir_url' => env(
        'SATUSEHAT_FHIR_URL',
        env('SATUSEHAT_ENV', 'staging') === 'production'
            ? 'https://api-satusehat.kemkes.go.id/fhir-r4/v1'
            : 'https://api-satusehat-stg.dto.kemkes.go.id/fhir-r4/v1'
    ),

    'client_id' => env('SATUSEHAT_CLIENT_ID', ''),
    'client_secret' => env('SATUSEHAT_CLIENT_SECRET', ''),

    'organization_id' => env('SATUSEHAT_ORGANIZATION_ID', ''),
    'organization_name' => env('SATUSEHAT_ORGANIZATION_NAME', 'RSIA Aisyiyah Pekajangan'),
];

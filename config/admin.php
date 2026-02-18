<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin IP Whitelist
    |--------------------------------------------------------------------------
    |
    | List of IP addresses that are allowed to access the admin panel.
    | Leave empty to allow all IPs (not recommended for production).
    | You can also set this in .env using ADMIN_ALLOWED_IPS
    |
    | Example: ['127.0.0.1', '172.16.55.82', '192.168.1.100']
    |
    */
    
    'allowed_ips' => array_filter(explode(',', env('ADMIN_ALLOWED_IPS', ''))),
];

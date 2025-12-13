<?php

return [
    'name' => env('COMPANY_NAME', 'Grey Cars Rental Co.'),
    'website' => env('COMPANY_WEBSITE', 'https://www.mycarrental.com'),
    'logo' => env('COMPANY_LOGO', ''),
    'contact' => [
        'address' => env('COMPANY_ADDRESS', '123 Default Address'),
        'phone' => env('COMPANY_PHONE', '+1 (555) 000-0000'),
        'email' => env('COMPANY_EMAIL', 'contact@example.com'),
        'whatsapp' => env('COMPANY_WHATSAPP', ''),
        'hours' => env('COMPANY_HOURS', 'Mon-Fri: 9AM-5PM'),
        'facebook' => env('COMPANY_FACEBOOK', '#'),
        'twitter' => env('COMPANY_TWITTER', '#'),
        'instagram' => env('COMPANY_INSTAGRAM', '#'),
        'linkedin' => env('COMPANY_LINKEDIN', '#'),
    ],

    'fees' => [
        'between_cities' => env('BETWEEN_CITIES_COST', 80),
    ]
];
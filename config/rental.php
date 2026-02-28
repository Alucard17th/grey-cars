<?php

return [
    'use_deposit' => env('USE_DEPOSIT', false),
    'currency_symbol' => env('APP_CURRENCY_SYMBOL', '€'),
    'send_order_to_email' => env('SEND_ORDER_TO_EMAIL', 'Greycars33@gmail.com'),
    'locations' => [
        'Agadir Airport - AL MASSIRA',
        'Marrakech Airport - AL MENARA',
        'Essaouira Airport - MOGADOR',
        'Taghazout',
        'Grey Cars Rental Agency',
    ],
];

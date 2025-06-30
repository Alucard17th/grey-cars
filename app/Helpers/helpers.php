<?php 

if (!function_exists('shouldApplyTransportFee')) {
    function shouldApplyTransportFee(string $pickup, string $dropoff): bool
    {
        $localCombinations = [
            'Agadir Airport - AL MASSIRA' => ['Taghazout', 'Grey Cars Rental Agency'],
            'Taghazout' => ['Grey Cars Rental Agency'],
            'Grey Cars Rental Agency' => ['Taghazout'],
        ];
        
        foreach ($localCombinations as $from => $toLocations) {
            if ($pickup === $from && in_array($dropoff, $toLocations)) {
                return false;
            }
            if ($dropoff === $from && in_array($pickup, $toLocations)) {
                return false;
            }
        }
        
        return $pickup !== $dropoff;
    }
}

if (! function_exists('car_icon')) {
    /**
     * Return a Bootstrap-Icons class for a given option/extra.
     * Falls back to "bi-check-circle" if no match found.
     */
    function car_icon(string $name): string
    {
        static $map = [
            // ---- Features / options ----
            'air conditioner'      => 'bi-snow',
            '5-door hatchback'     => 'bi-door-closed',
            '3-suitcase capacity'  => 'bi-suitcase',
            'touchscreen'          => 'bi-display',
            'gps'                  => 'bi-geo-alt',

            // ---- Extras ----
            'extra driver'         => 'bi-person-plus',
            'child seat'           => 'bi-baby-carriage',
            'premium insurance'    => 'bi-shield-check',
        ];

        $key = strtolower(trim($name));
        return $map[$key] ?? 'bi-check-circle';   // default icon
    }
}
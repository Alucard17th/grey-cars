<?php 

if (!function_exists('shouldApplyTransportFee')) {
    function shouldApplyTransportFee(string $pickup, string $dropoff): int
    {
        $localCombinations = [
            'Agadir Airport - AL MASSIRA' => ['Taghazout', 'Grey Cars Rental Agency'],
            'Taghazout' => ['Grey Cars Rental Agency'],
            'Grey Cars Rental Agency' => ['Taghazout'],
        ];

        $localLocations = [];
        foreach ($localCombinations as $from => $toLocations) {
            $localLocations[$from] = true;
            foreach ($toLocations as $to) {
                $localLocations[$to] = true;
            }
        }

        $pickupIsLocal = isset($localLocations[$pickup]);
        $dropoffIsLocal = isset($localLocations[$dropoff]);

        if ($pickupIsLocal && $dropoffIsLocal) {
            return 0;
        }

        if ($pickup === $dropoff) {
            return 2;
        }

        if ($pickupIsLocal || $dropoffIsLocal) {
            return 1;
        }

        return 2;
    }
}

if (! function_exists('car_icon')) {
    /**
     * Return HTML for the icon that represents a given option/extra.
     * Defaults to a generic “check-circle” icon.
     */
    function car_icon(string $name): string
    {
        // Purely constant data – no function calls.
        static $map = [
            // ---- Features / options ----
            'air conditioner'      => '<i class="bi bi-snow me-1 fs-5"></i>',
            // '5-door hatchback'     => '<i class="bi bi-door-closed me-1 fs-5"></i>',
            '3-suitcase capacity'  => '<i class="bi bi-suitcase me-1 fs-5"></i>',
            'touchscreen'          => '<i class="bi bi-display me-1 fs-5"></i>',
            'gps'                  => '<i class="bi bi-geo-alt me-1 fs-5"></i>',

            // ---- Extras ----
            'extra driver'         => '<i class="bi bi-person-plus me-1 fs-5"></i>',
            // 'baby seat' => will be handled dynamically below
            'kayak roof rack/surfboard' => '<i class="bi bi-tsunami me-1 fs-5"></i>',
            'booster seat'         => '<i class="bi bi-shield-check me-1 fs-5"></i>',
        ];

        $key = strtolower(trim($name));

        // Special-case items that need run-time helpers
        if ($key === 'baby seat') {
            return '<img src="'.asset('images/icons/maxi-cozi.png').'"
                        alt="baby seat" style="width:20px;height:20px;" class="me-1"/>';
        }

        if ($key === '5-door hatchback') {
            return '<img src="'.asset('images/icons/doors.png').'"
                        alt="baby seat" style="width:20px;height:20px;" class="me-1"/>';
        }

        // Return mapped icon or default
        return $map[$key] ?? '<i class="bi bi-check-circle me-1 fs-5"></i>';
    }
}
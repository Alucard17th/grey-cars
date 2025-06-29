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
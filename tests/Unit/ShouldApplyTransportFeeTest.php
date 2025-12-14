<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ShouldApplyTransportFeeTest extends TestCase
{
    #[DataProvider('transportFeeMultiplierProvider')]
    public function test_should_apply_transport_fee_multiplier(string $pickup, string $dropoff, int $expectedMultiplier): void
    {
        $this->assertSame($expectedMultiplier, shouldApplyTransportFee($pickup, $dropoff));
    }

    public static function transportFeeMultiplierProvider(): array
    {
        return [
            'both local different locations => 0' => ['Taghazout', 'Grey Cars Rental Agency', 0],
            'both local different locations (airport) => 0' => ['Agadir Airport - AL MASSIRA', 'Taghazout', 0],
            'same local location => 0' => ['Taghazout', 'Taghazout', 0],

            'one local (pickup local) => 1' => ['Taghazout', 'Marrakech Airport - AL MENARA', 1],
            'one local (dropoff local) => 1' => ['Marrakech Airport - AL MENARA', 'Taghazout', 1],

            'neither local different locations => 2' => ['Marrakech Airport - AL MENARA', 'Casablanca Airport - MOHAMMED V', 2],
            'same non-local location => 2' => ['Marrakech Airport - AL MENARA', 'Marrakech Airport - AL MENARA', 2],
        ];
    }
}

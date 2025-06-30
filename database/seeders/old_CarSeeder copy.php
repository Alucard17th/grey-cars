<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OLDCarSeeder extends Seeder
{
    const SHARED_IMAGE_PATH = 'cars/shared-car-image.jpg';
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, ensure our shared image exists in storage
        $this->ensureSharedImageExists();

        // Define car data - all using the same image
        $cars = [
            [
                'name' => 'Toyota Camry',
                'year' => 2022,
                'color' => '#2a5885',
                'price_per_day' => 89.99,
                'security_deposit_per_day' => 15.00,
                'security_deposit_fixed' => null,
                'options' => ['GPS', 'Bluetooth', 'Air Conditioning', 'Backup Camera'],
                'extras' => [
                    'Extra Driver' => '10€',
                    'Child Seat' => '5€',
                    'GPS Navigation' => '8€'
                ],
            ],
            [
                'name' => 'Honda Accord',
                'year' => 2021,
                'color' => '#c0392b',
                'price_per_day' => 85.50,
                'security_deposit_per_day' => null,
                'security_deposit_fixed' => 250.00,
                'options' => ['Sunroof', 'Heated Seats', 'Apple CarPlay', 'Android Auto'],
                'extras' => [
                    'Extra Driver' => '10€',
                    'Child Seat' => '5€',
                    'Premium Insurance' => '15€'
                ],
            ],
            [
                'name' => 'Ford Mustang',
                'year' => 2023,
                'color' => '#1e1e1e',
                'price_per_day' => 149.99,
                'security_deposit_per_day' => 25.00,
                'security_deposit_fixed' => null,
                'options' => ['Premium Sound System', 'Leather Seats', 'Sport Mode', 'Performance Package'],
                'extras' => [
                    'Extra Driver' => '15€',
                    'Track Day Package' => '50€',
                    'Premium Insurance' => '20€'
                ],
            ],
            [
                'name' => 'Tesla Model 3',
                'year' => 2023,
                'color' => '#e74c3c',
                'price_per_day' => 129.99,
                'security_deposit_per_day' => null,
                'security_deposit_fixed' => 500.00,
                'options' => ['Autopilot', 'Electric', 'Premium Interior', 'Keyless Entry'],
                'extras' => [
                    'Supercharger Credit' => '20€',
                    'Child Seat' => '5€',
                    'Premium Connectivity' => '10€'
                ],
            ],
            [
                'name' => 'BMW X5',
                'year' => 2022,
                'color' => '#3498db',
                'price_per_day' => 159.99,
                'security_deposit_per_day' => 30.00,
                'security_deposit_fixed' => null,
                'options' => ['4WD', 'Panoramic Sunroof', 'Navigation', 'Heated Steering Wheel'],
                'extras' => [
                    'Extra Driver' => '15€',
                    'Ski Rack' => '12€',
                    'Winter Tire Package' => '25€'
                ],
            ],
            [
                'name' => 'Mercedes-Benz C-Class',
                'year' => 2021,
                'color' => '#f1c40f',
                'price_per_day' => 139.99,
                'security_deposit_per_day' => null,
                'security_deposit_fixed' => 350.00,
                'options' => ['Premium Package', 'Ambient Lighting', 'Memory Seats', 'Wireless Charging'],
                'extras' => [
                    'Chauffeur Service' => '50€',
                    'Airport Pickup' => '30€',
                    'Premium Cleaning' => '20€'
                ],
            ],
            [
                'name' => 'Audi A4',
                'year' => 2022,
                'color' => '#2c3e50',
                'price_per_day' => 119.99,
                'security_deposit_per_day' => 20.00,
                'security_deposit_fixed' => null,
                'options' => ['Virtual Cockpit', 'Bang & Olufsen Sound', 'Quattro AWD', 'LED Headlights'],
                'extras' => [
                    'Extra Driver' => '10€',
                    'Toll Pass' => '5€',
                    'Valet Service' => '15€'
                ],
            ],
            [
                'name' => 'Jeep Wrangler',
                'year' => 2023,
                'color' => '#27ae60',
                'price_per_day' => 109.99,
                'security_deposit_per_day' => null,
                'security_deposit_fixed' => 300.00,
                'options' => ['Off-Road Package', 'Removable Top', 'Tow Package', 'All-Terrain Tires'],
                'extras' => [
                    'Camping Kit' => '25€',
                    'Roof Tent' => '40€',
                    'Off-Road Guide' => '30€'
                ],
            ],
            [
                'name' => 'Chevrolet Suburban',
                'year' => 2022,
                'color' => '#7f8c8d',
                'price_per_day' => 139.99,
                'security_deposit_per_day' => 25.00,
                'security_deposit_fixed' => null,
                'options' => ['Third Row Seating', 'DVD Entertainment', 'Power Running Boards', 'Heated Rear Seats'],
                'extras' => [
                    'Extra Driver' => '15€',
                    'Child Seat (x2)' => '8€',
                    'Luggage Rack' => '12€'
                ],
            ],
            [
                'name' => 'Porsche 911',
                'year' => 2023,
                'color' => '#e74c3c',
                'price_per_day' => 299.99,
                'security_deposit_per_day' => null,
                'security_deposit_fixed' => 1000.00,
                'options' => ['Sport Chrono Package', 'Premium Package', 'Performance Exhaust', 'Carbon Ceramic Brakes'],
                'extras' => [
                    'Track Insurance' => '75€',
                    'Performance Instructor' => '100€',
                    'Helmet Rental' => '15€'
                ],
            ],
        ];

        // Create all cars using the same image
        foreach ($cars as $carData) {
            Car::create(array_merge($carData, [
                'image' => self::SHARED_IMAGE_PATH
            ]));
        }
    }

    /**
     * Ensure the shared image exists in storage
     */
    protected function ensureSharedImageExists(): void
    {
        // Check if image already exists in storage
        if (!Storage::disk('public')->exists(self::SHARED_IMAGE_PATH)) {
            // Create cars directory if it doesn't exist
            Storage::disk('public')->makeDirectory('cars');
            
            // Path to your source image
            $sourcePath = 'E:\WORK\grey-cars\public\storage\cars\6844acbf410ef.jpg';
            
            // Verify source image exists
            if (!file_exists($sourcePath)) {
                throw new \Exception("Source image not found at: {$sourcePath}");
            }
            
            // Copy to storage
            copy($sourcePath, storage_path('app/public/' . self::SHARED_IMAGE_PATH));
        }
    }
}
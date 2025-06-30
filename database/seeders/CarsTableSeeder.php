<?php
// database/seeders/CarsTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /** Universal list of extras with prices (MAD per day) */
    private array $baseExtras = [
        'Extra Driver'      => 10,
        'Child Seat'        => 5,
        'Premium Insurance' => 15,
    ];

    public function run(): void
    {
        $cars = [
            [
                'name'                     => 'DACIA LOGAN',
                'transmission'             => 'Manual',
                'engine'                   => 'Diesel',
                'year'                     => 2023,
                'price_per_day'            => 30,
                'image'                    => 'images/cars/dacia_logan_gasoil_manuelle_2023.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Choose the Dacia Logan, an economical, reliable and easy-to-drive car. Perfect for city journeys or Moroccan getaways, it combines comfort, space and simplicity.',
            ],
            [
                'name'                     => 'VOLKSWAGEN TOUAREG',
                'transmission'             => 'Automatic',
                'engine'                   => 'Diesel',
                'year'                     => 2024,
                'price_per_day'            => 120,
                'image'                    => 'images/cars/volkswagen_touareg.png',
                'security_deposit_per_day' => 1800,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'Touchscreen',
                    'GPS',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Treat yourself to luxury and comfort with our Volkswagen Touareg. Designed for modern adventurers, this premium SUV blends power, elegance and performance.',
            ],
            [
                'name'                     => 'VW T-ROC AUTOMATIC',
                'transmission'             => 'Automatic',
                'engine'                   => 'Diesel',
                'year'                     => 2024,
                'price_per_day'            => 80,
                'image'                    => 'images/cars/vw_troc_automatique.png',
                'security_deposit_per_day' => 1500,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'Touchscreen',
                    'GPS',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Compact, stylish and powerful, the Volkswagen T-Roc is ideal for exploring Morocco—whether in the city or off the beaten track.',
            ],
            [
                'name'                     => 'RENAULT CLIO 5',
                'transmission'             => 'Manual',
                'engine'                   => 'Diesel',
                'year'                     => 2025,
                'price_per_day'            => 35,
                'image'                    => 'images/cars/renault_clio5_manuelle_gasoil.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Practical, economical and dynamic, the Clio 5 with manual gearbox delivers 90 hp for agile driving.',
            ],
            [
                'name'                     => 'RENAULT CLIO 5',
                'transmission'             => 'Automatic',
                'engine'                   => 'Petrol',
                'year'                     => 2024,
                'price_per_day'            => 35,
                'image'                    => 'images/cars/renault_clio5_bva_2025.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'The 2025 Renault Clio 5 Automatic combines elegance and technology. Its 100 hp TCe petrol engine and CVT gearbox provide a smooth, pleasant drive.',
            ],
            [
                'name'                     => 'DACIA JOGGER',
                'transmission'             => 'Manual',
                'engine'                   => 'Diesel',
                'year'                     => 2024,
                'price_per_day'            => 40,
                'image'                    => 'images/cars/dacia_jogger_2024_manuelle_gasoil.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'With its manual gearbox and roomy interior, the Dacia Jogger offers everyday comfort and style.',
            ],
            [
                'name'                     => 'PEUGEOT 208 (Grey)',
                'transmission'             => 'Manual',
                'engine'                   => 'Diesel',
                'year'                     => 2023,
                'price_per_day'            => 30,
                'image'                    => 'images/cars/peugeot_208_2023_gris_gasoil_manuelle.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'GPS',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Dynamic and economical, the manual Peugeot 208 is perfect for city driving.',
            ],
            [
                'name'                     => 'PEUGEOT 208 (White)',
                'transmission'             => 'Manual',
                'engine'                   => 'Diesel',
                'year'                     => 2023,
                'price_per_day'            => 30,
                'image'                    => 'images/cars/peugeot_208_2023_blanche_gasoil_manuelle.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'GPS',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Dynamic and economical, the manual Peugeot 208 is perfect for city driving.',
            ],
            [
                'name'                     => 'DACIA DUSTER',
                'transmission'             => 'Automatic',
                'engine'                   => 'Diesel',
                'year'                     => 2023,
                'price_per_day'            => 45,
                'image'                    => 'images/cars/dacia_duster_2023_bva_gasoil.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'GPS',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Dacia Duster Automatic – comfort, power and versatility.',
            ],
            [
                'name'                     => 'DACIA LOGAN (Essence Auto)',
                'transmission'             => 'Manual',
                'engine'                   => 'Diesel',
                'year'                     => 2023,
                'price_per_day'            => 30,
                'image'                    => 'images/cars/dacia_logan_2023_essence_automatique.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Spacious, reliable and economical, the Dacia Logan diesel is perfect for long journeys.',
            ],
            [
                'name'                     => 'DACIA SANDERO',
                'transmission'             => 'Manual',
                'engine'                   => 'Petrol',
                'year'                     => 2025,
                'price_per_day'            => 25,
                'image'                    => 'images/cars/dacia_sandero_2025_essence_manuelle.png',
                'security_deposit_per_day' => 900,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Comfortable, economical and modern, the 2025 Dacia Sandero is perfect for your trips.',
            ],
            [
                'name'                     => 'VOLKSWAGEN GOLF 8',
                'transmission'             => 'Automatic',
                'engine'                   => 'Diesel',
                'year'                     => 2023,
                'price_per_day'            => 80,
                'image'                    => 'images/cars/golf8_diesel_2025.png',
                'security_deposit_per_day' => 1500,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'Touchscreen',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'The Volkswagen Golf 8 combines refined design, advanced technology and enjoyable driving.',
            ],
            [
                'name'                     => 'SKODA OCTAVIA',
                'transmission'             => 'Automatic',
                'engine'                   => 'Diesel',
                'year'                     => 2024,
                'price_per_day'            => 70,
                'image'                    => 'images/cars/skoda_octavia_2025_automatique.png',
                'security_deposit_per_day' => 1200,
                'security_deposit_fixed'   => true,
                'options'                  => [
                    'Air conditioner',
                    '5-Door Hatchback',
                    '3-Suitcase Capacity',
                    'Touchscreen',
                    'GPS',
                ],
                'extras'                   => $this->baseExtras,
                'description'              => 'Comfortable and efficient, the Skoda Octavia Automatic delivers a smooth ride and generous space.',
            ],
        ];

        /* — Insert via model so casts handle JSON — */
        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}

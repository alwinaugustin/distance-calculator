<?php

namespace Tests\Feature;

use Tests\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * Test distance calulator
     *
     * @return void
     */
    public function testDistanceCalculatorSuccessfully()
    {
        $units = ['yd', 'm'];

        $payload = [
            'distance_data' =>[
                [
                    'distance' =>rand(1,1000),
                    'unit'=> $units[array_rand($units, 1)]
                ],
                [
                    'distance'=>rand(1,1000),
                    'unit'=>$units[array_rand($units, 1)]
                ]
            ],
            'output_unit'=>$units[array_rand($units, 1)]
        ];

        $this
            ->json('POST', 'api/calculate-distance', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'status',
                'total'
            ]);
    }

    /**
     * Test required fields
     *
     * @return void
     */
    public function testRequiresDistanceAndUnits()
    {
        $payload = [
            'distance_data' =>[
                [
                    'distance' =>null,
                    'unit'=>null
                ],
                [
                    'distance'=>null,
                    'unit'=>null
                ]
            ],
            'output_unit'=>null
        ];

        $this
            ->json('POST', 'api/calculate-distance', $payload)
            ->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }
}

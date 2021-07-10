<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistanceCalculatorRequest;

/**
 * DistanceCalculatorController class
 */
class DistanceCalculatorController extends Controller
{
    /**
     * Calculate total distance
     *
     * @param DistanceCalculatorRequest $request
     * @return json
     */
    public function calculate(DistanceCalculatorRequest $request)
    {

        $inputData          = $request->all();
        $totalDistance      = $this->calculateTotal($inputData);

        $data = [
            'data' => [
                'message' => 'Total distance in ' . $inputData['output_unit'],
                'status' => 'success',
                'total' => $totalDistance . ' ' . $inputData['output_unit']
            ]
        ];

        return response()->json($data, 200);
    }

    /**
     * Convert units and calculate total
     *
     * @param array $input
     * @return float
     */
    private function calculateTotal(array $input): float
    {
        $unitMap    = config('unit_map');
        $outputUnit = $input['output_unit'];

        $firstDistanceMeters    = $input['distance_data'][0]['distance'] * $unitMap[$input['distance_data'][0]['unit']];
        $secondDistanceMeters   = $input['distance_data'][1]['distance'] * $unitMap[$input['distance_data'][1]['unit']];
        $totalUnits             = $firstDistanceMeters + $secondDistanceMeters;

        $totalInOpUnits         = (float)$totalUnits / $unitMap[$outputUnit];

        return $totalInOpUnits;
    }
}

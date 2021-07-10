## Distance Calculator API

### Files Modified

- routes/api.php
- app/Http/Controllers/DistanceCalculatorController.php
- app/Http/Requests/DistanceCalculateRequest.php
- config/unit_map.php
- tests/Feature/CalculatorTest.php

### How to run


1. Install Composer
2. Run `composer install`
3. Run `php artisan serve`
4. Access `http://127.0.0.1:8000/api/calculate-distance`

### Example Request

```
curl --location --request POST 'http://127.0.0.1:8000/api/calculate-distance' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "distance_data": [
        {
            "distance": 4,
            "unit": "yd"
        },
        {
            "distance": 4,
            "unit": "yd"
        }
    ],
    "output_unit": "m"
}'
```

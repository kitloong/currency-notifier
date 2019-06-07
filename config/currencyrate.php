<?php
/**
 * Created by PhpStorm.
 * User: liow.kitloong
 * Date: 2019-06-02
 * Time: 17:17
 */

return [
    'profile' => [
        1 => [
            'currencies' => [
                'CNY' => 'USD',
                'USD' => 'MYR'
            ],
            'satisfactory_threshold' => 0.62,
            'warning_threshold' => 0.60
        ]
    ],

    'api' => [
        'currency_converter_api' => [
            'key' => env('CURRENCY_CONVERTER_API_KEY')
        ]
    ],

    // Supply multiple email by separated comma.
    'recipients' => env('CURRENCY_NOTIFICATION_RECIPIENTS')
];

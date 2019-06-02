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
            'rates' => [
                'CNY' => 'USD',
                'USD' => 'MYR'
            ]
        ]
    ],

    'api' => [
        'currency_converter_api' => [
            'key' => env('CURRENCY_CONVERTER_API_KEY')
        ]
    ]
];

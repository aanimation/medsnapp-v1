<?php

declare(strict_types=1);

return [
    'api_key' => env('LOOPS_API_KEY'),
    'transactional' => [
        'new' => env('LOOPS_TR_NEW', 'cm1f4alco018g60gpfszssv63'),
        'welcome' => env('LOOPS_TR_WELCOME', 'cm1f4llb001qbii9pxgt8tcl4'),
        'invite' => env('LOOPS_TR_INVITE', 'cm1estiey030bgp4sshddfstv'),
        'reset-password' => env('LOOPS_TR_RESET_PASSWORD', 'cm1eqop7401p5eu6ux7av6gl5'),
        'reminder' => env('LOOPS_TR_REMINDER', 'cm1et5bsc016zv5mfmwdc4zgz'),
        'upgrade' => env('LOOPS_TR_UPGRADE', 'cm1exrztx0102e2i463az34sy'),
        'currency' => env('LOOPS_TR_CURRENCY', 'cm1f1ue0003x2znebl2yrw422'),
        'payment-succeded' => env('LOOPS_TR_PAYMENT_SUCCEEDED', 'cm1ey7czb01f7suiajmqtobk1'),
        'new-patient' => env('LOOPS_TR_NEW_PATIENT', 'cm3ftm4p9022p104hbyipwf5q'),
    ],
    'admin' => [
        'contact-message' => 'cm1lvw8pa00jc14lzw5z1q1mq',
    ],
];

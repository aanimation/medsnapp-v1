<?php

return [
	'currency' => env('STRIPE_CURRENCY', 'GBP'),
	'key' => env('STRIPE_KEY', 'pk_testxxxx'),
	'secret' => env('STRIPE_SECRET', 'sk_testxxxx'),
	'webhook' => env('STRIPE_WEBHOOK', 'we_1PiI1I2KuEQgcpEhr5ZuMf1A'),
	'sign' => env('STRIPE_SIGN', 'whsec_xxxx'),
];
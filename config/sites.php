<?php

return [
	'urls' => [
		'development' => env('LOCAL_URL','http://localhost/'),
		'staging' => env('STAGING_URL','https://staging.medsnapp.com'),
		'main' => env('MAIN_URL','https://medsnapp.com'),
		'platform' => env('PLATFORM_URL','https://app.medsnapp.com')
	],
];
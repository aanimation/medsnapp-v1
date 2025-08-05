<?php

namespace App\Traits;

use Auth;
use Exception;
use GuzzleHttp\Client as GuzzleClient;

trait BeehiivTraits
{

	/**
	 * Create Subscriptions
	 */

	public function beehiivCreateSubscription(string $email)
	{
		$pubId = config('services.beehiiv.api_v2.publication_id');
		$beehiivUrl = config('services.beehiiv.url');
		$apiKey = config('services.beehiiv.api_key');

		$client = new GuzzleClient();
		$response = $client->request('POST', $beehiivUrl.$pubId.'/subscriptions', [
  				'body' => '{
  					"email": '.$email.',
  					"reactivate_existing": false,
  					"send_welcome_email": false,
  					"utm_source": "Medsnapp-Dev",
  					"utm_campaign": "waitlist_campaign",
  					"utm_medium": "organic",
  					"referring_site": "www.staging.medsnapp.com/blog",
  					"custom_fields": []
				}',
  				'headers' => [
    				'Accept' => 'application/json',
    				'Authorization' => 'Bearer '.$apiKey,
    				'Content-Type' => 'application/json',
  				],
		]);

		dump($response->getBody());
	}

}
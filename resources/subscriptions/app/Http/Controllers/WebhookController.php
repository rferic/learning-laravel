<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebhookController extends \Laravel\Cashier\Http\Controllers\WebhookController
{
	public function handleCustomerSubscriptionDeleted(array $payload)
	{
		return new Response('Override', 200);
	}

	public function handleChargeFailed(array $payload)
	{
		return new Response('Charge Failed', 200);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebhookController extends \Laravel\Cashier\Http\Controllers\WebhookController
{
    //TODO Overrides Webhook Handler (Cashier - Stripe)
    
    protected function handleCustomerSubscriptionDeleted(array $payload){
        return new Response('Override customer.subscription.deleted', 200);
    }

    public function handleChargeFailed(array $payload){
		return new Response('Charge Failed', 200);
	}
}

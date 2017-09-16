<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function form()
    {
    	return view('subscriptions.form');
    }

    public function subscribe(Request $request)
    {
	    $token = $request->input('stripeToken');
	    try{
		    if ($request->has('coupon'))
		    {
			    $request->user()
				    ->newSubscription('main-'.$request->input('type'), $request->input('type'))
				    ->withCoupon($request->input('coupon'))->create($token);
		    }
		    else
		    {
			    $request->user()
				    ->newSubscription('main-'.$request->input('type'), $request->input('type'))
				    ->create($token);
		    }
		    return redirect('profile')
			    ->with('message', 'La suscripción se ha llevado a cabo correctamente');
	    }
	    catch (\Exception $exception)
	    {
		    $error = $exception->getMessage();
		    return redirect('subscription')->with('error', 'Error: ' . $error);
	    }
    }

	public function cancel($subscription)
	{
		auth()->user()->subscription($subscription)->cancel();
		return redirect('profile')->with('message', 'La suscripción se ha cancelado correctamente');
	}

	public function upgrade(Request $request)
	{
		$nextPlan = "quarterly";
		if($request->input('stripe_plan') === "quarterly")
		{
			$nextPlan = "yearly";
		}

		$request->user()->subscription($request->input('plan'))->swap($nextPlan);
		return redirect('profile')->with('message', sprintf('Has subido tu suscripción a %s', $nextPlan));
	}

	public function resume(Request $request)
	{
		$subscription = $request->user()->subscription($request->input('plan'));
		if ($subscription->cancelled() && $subscription->onGracePeriod())
		{
			$request->user()->subscription($request->input('plan'))->resume();
			return redirect('profile')->with('message', 'Has reanudado tu suscripción correctamente');
		}
		return redirect('profile');
	}
}

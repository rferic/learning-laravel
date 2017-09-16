<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function form(){
        return view('subscription.form');
    }

    public function subscribe(Request $request){
	    $token = $request->input('stripeToken');

        //TODO try Suscribe User with Stripe
	    try{
            //TODO Check if user have got a coupon discount
		    if ($request->has('coupon')){
                //TODO Crearte Subscription with Coupon (Cashier - Stripe)
			    $request->user()
				    ->newSubscription('main-'.$request->input('type'), $request->input('type'))
				    ->withCoupon($request->input('coupon'))->create($token);
		    }else{
                //TODO Create Subscription (Cashier - Stripe)
			    $request->user()
				    ->newSubscription('main-'.$request->input('type'), $request->input('type'))
				    ->create($token);
		    }

		    return redirect('profile')->with('message', 'User has been suscribed');

	    }catch (\Exception $exception){
            //TODO Detect Stripe Error
		    $error = $exception->getMessage();
		    return redirect('subscription')->with('error', 'Error: ' . $error);
	    }
    }

    public function cancel($subscription){
        //TODO Cancel Subscription (Cashier - Stripe)
        auth()->user()->subscription($subscription)->cancel();
        return redirect('profile')->with('message', 'Subscription has been cancelled');
    }

    public function upgrade(Request $request){
        //TODO Upgrade Subscription (Cashier - Stripe)
        switch ($request->input('stripe_plan')) {
            case 'monthly':
                $nextPlan = 'quarterly';
                break;
            case 'quarterly':
                $nextPlan = 'yearly';
                break;
            default:
                return redirect('profile')->with('error', 'Your subscription not have a higher plan');
        }

        //TODO SWAP() => Change plan of subscription to new plan
        auth()->user()->subscription($request->input('plan'))->swap($nextPlan);
        return redirect('profile')->with('message', 'Your subscription has been upgraded');
    }

    public function resume(Request $request){
        //TODO Renovate Subscription (Cashier - Stripe)
        //TODO Get subscription
        $subscription = auth()->user()->subscription($request->input('plan'));

        //TODO Check if Subscription has been cancelled and is in Grace Period (Cancell but NOT Finish)
        if($subscription->cancelled() && $subscription->onGracePeriod()){
            //TODO RESUME() => Renovate Subscription
            $subscription->resume();
            return redirect('profile')->with('message', 'Your subscription has been renovated');
        }

        return redirect('profile')->with('error', 'Your subscription not has been renovated because not has been cancelled or is without grace period');
    }
}

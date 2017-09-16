@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if(auth()->user()->subscriptions->count())
            <a class="btn btn-success pull-right" href="/invoices">My invoices</a>
            <div class="clearfix"></div>
        @endif

        @forelse(auth()->user()->subscriptions AS $subscription)

            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        StripeId: {{ $subscription->stripe_id }}
                    </div>
                </div>

                <div class="panel-body">
                    <p>Subscription type: <b>{{ $subscription->stripe_plan }}</b></p>
                    <p>Contract since: <b>{{ $subscription->created_at->format('d/m/Y') }}</b></p>

                    <!--if is on Grace period => Subscription has been cancelled but has not yet expired-->
                    @if(auth()->user()->subscription($subscription->name)->onGracePeriod())
                        <hr />

                        Subscription cancel: <b>Valid until {{ $subscription->ends_at->format('d/m/Y H:i:s') }}</b>&nbsp;

                        <!-- Renew subscription -->
                        <form style="display: inline;" action="subscription/resume" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                            <button class="btn btn-sm btn-warning">
                                Renew subscription
                            </button>
                        </form>
                        <!-- ./Renew subscription -->
                    @endif
                </div>
                <div class="panel-footer">

                    <a href="subscription/cancel/{{ $subscription->name }}" class="btn btn-sm btn-danger">
                        Cancel subscription
                    </a>
                    @if($subscription->stripe_plan !== 'yearly')
                        <form style="display: inline;" action="subscription/upgrade" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                            <input type="hidden" name="stripe_plan" value="{{ $subscription->stripe_plan }}" />
                            <button class="btn btn-sm btn-warning">
                                Upgrade subscription
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        @empty

            <div class="alert alert-danger col-md-4 col-md-offset-4 text-center">
                Subscriptions not found
            </div>
            <a class="btn btn-info col-md-4 col-md-offset-4" href="/subscription">Choose a Plan</a>

        @endforelse

    </div>
@endsection

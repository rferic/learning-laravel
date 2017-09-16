@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if(auth()->user()->subscriptions->count())
            <a class="btn btn-success pull-right" href="/invoices">Mis facturas</a>
            <div class="clearfix"></div>
        @endif

        @forelse(auth()->user()->subscriptions as $subscription)
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        StripeId: {{ $subscription->stripe_id }}
                    </div>
                </div>

                <div class="panel-body">
                    <p>Tipo de suscripción: <b>{{ $subscription->stripe_plan }}</b></p>
                    <p>Contratado desde: <b>{{ $subscription->created_at->format('d/m/Y') }}</b></p>

                    <!--si está en período de gracia-->
                    @if(auth()->user()->subscription($subscription->name)->onGracePeriod())
                        <hr />
                        Suscripción Cancelada: <b>Vigente hasta {{ $subscription->ends_at->format('d/m/Y H:i:s') }}</b>&nbsp;

                        <!-- reanudar suscripción -->
                        <form style="display: inline;" action="subscription/resume" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                            <button class="btn btn-sm btn-warning">
                                Reanudar suscripción
                            </button>
                        </form>
                        <!-- ./reanudar suscripción -->
                    @endif
                </div>
                <div class="panel-footer">

                    <a href="subscription/cancel/{{ $subscription->name }}" class="btn btn-sm btn-danger">
                        Cancelar suscripción
                    </a>
                    @if($subscription->stripe_plan != 'yearly')
                        <form style="display: inline;" action="subscription/upgrade" method="POST">
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                            <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                            <input type="hidden" name="stripe_plan" value="{{ $subscription->stripe_plan }}" />
                            <button class="btn btn-sm btn-warning">
                                Subir suscripción
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-danger col-md-4 col-md-offset-4 text-center">No tiene suscripciones</div>
            <a class="btn btn-info col-md-4 col-md-offset-4" href="/subscription">Contratar un plan</a>
        @endforelse

    </div>
@endsection
@extends('layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="/css/pricing.css" />
@endpush

@section('content')
    <div class="container content">
        <div class="row">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h2 class="text-center text-muted">Tabla de suscripciones</h2>
            <hr />
            <!-- Pricing -->
            <div class="col-md-4">
                <div class="pricing hover-effect">
                    <div class="pricing-head">
                        <h3>Iniciando <span>
					Durante 1 mes </span>
                        </h3>
                        <h4><i>€</i>9<i>.99</i>
                            <span>
					Cada mes </span>
                        </h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li>
                            Acceso a todos los cursos durante 1 mes
                        </li>
                        <li>
                            Soporte en menos de 24h
                        </li>
                        <li>
                            Acceso a todos los archivos
                        </li>
                        <li>
                            <span style="text-decoration: line-through">
                                Consultas particulares en caso de dudas por skype
                            </span>
                        </li>
                    </ul>
                    <div class="pricing-footer">
                        <a href="javascript:;" class="btn yellow-crusta">
                            @include('partials.stripe.form', ['name' => 'Suscripción', 'description' => 'Mensual', 'type' => 'monthly'])
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing pricing-active hover-effect">
                    <div class="pricing-head pricing-head-active">
                        <h3>Pro <span>
					Durante 3 meses </span>
                        </h3>
                        <h4><i>€</i>24<i>.99</i>
                            <span>
					Cada 3 meses </span>
                        </h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li>
                            Acceso a todos los curso durante 3 meses
                        </li>
                        <li>
                            Soporte en menos de 24h
                        </li>
                        <li>
                            Acceso a todos los archivos
                        </li>
                        <li>
                            <span style="text-decoration: line-through">
                                Consultas particulares en caso de dudas por skype
                            </span>
                        </li>
                    </ul>
                    <div class="pricing-footer">
                        <a href="javascript:;" class="btn yellow-crusta">
                            @include('partials.stripe.form', ['name' => 'Suscripción', 'description' => 'Trimestral', 'type' => 'quarterly'])
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing hover-effect">
                    <div class="pricing-head">
                        <h3>Experto <span>
                                1 año completo
                            </span>
                        </h3>
                        <h4><i>€</i>99<i>.99</i>
                            <span>
					Cada año </span>
                        </h4>
                    </div>
                    <ul class="pricing-content list-unstyled">
                        <li>
                            Acceso a todos los curso durante 1 año
                        </li>
                        <li>
                            Soporte en menos de 24h
                        </li>
                        <li>
                            Acceso a todos los archivos
                        </li>
                        <li>
                            <span>
                                Consultas particulares en caso de dudas por skype
                            </span>
                        </li>
                    </ul>
                    <div class="pricing-footer">
                        <a href="javascript:;" class="btn yellow-crusta">
                            @include('partials.stripe.form', ['name' => 'Suscripción', 'description' => 'Anual', 'type' => 'yearly'])
                        </a>
                    </div>
                </div>
            </div>
            <!--//End Pricing -->
        </div>
    </div>
@endsection
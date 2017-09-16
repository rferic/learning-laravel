@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-md-12">

            <a class="btn btn-success pull-right" href="/profile">Mi perfil</a>
            <div class="clearfix"></div>

            <div class="panel panel-info">

                <div class="panel-heading">
                    <div class="panel-title">
                        Facturas
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha de la suscripción</th>
                                <th>Coste de la suscripción</th>
                                <th>Cupón</th>
                                <th>Descargar factura</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td>{{ $invoice->total() }}</td>
                                @if ($invoice->hasDiscount())
                                    <td>Cupón:  ({{ $invoice->coupon() }} / {{ $invoice->discount() }})</td>
                                @else
                                    <td>No se ha utilizado ningún cupón</td>
                                @endif
                                <td><a href="/invoice/{{ $invoice->id }}">Descargar</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>
@endsection
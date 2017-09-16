@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-md-12">

            <a class="btn btn-success pull-right" href="/profile">My profile</a>
            <div class="clearfix"></div>

            <div class="panel panel-info">

                <div class="panel-heading">
                    <div class="panel-title">
                        Invoices
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Subscription date</th>
                                <th>Price</th>
                                <th>Coupon</th>
                                <th>Download Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td>{{ $invoice->total() }}</td>
                                @if ($invoice->hasDiscount())
                                    <td>Coupon:  ({{ $invoice->coupon() }} / {{ $invoice->discount() }})</td>
                                @else
                                    <td><i>Coupon not found</i></td>
                                @endif
                                <td><a href="/invoice/{{ $invoice->id }}">Donwload</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- TODO Invoice Template (Cashier - Stripe) --}}
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>My Test Invoice</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        body {
            background: #fff;
            background-image: none;
            font-size: 12px;
        }
        address{
            margin-top:15px;
        }
        h2 {
            font-size:28px;
            color:#cccccc;
        }
        .container {
            padding-top:30px;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .logo {
            padding-bottom: 10px;
        }
        .table th {
            vertical-align: bottom;
            font-weight: bold;
            padding: 8px;
            line-height: 20px;
            text-align: left;
        }
        .table td {
            padding: 8px;
            line-height: 20px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dddddd;
        }
        .well {
            margin-top: 15px;
        }
        </style>
    </head>

    <body>
        <div class="container">
            <table style="margin-left: auto; margin-right: auto" width="550">
                <tr>
                    <td width="160">
                        &nbsp;
                    </td>

                    <!-- Organization Name / Image -->
                    <td align="right">
                        <strong>{{ $header or $vendor }}</strong>
                    </td>
                </tr>
                <tr valign="top">
                    <td style="font-size:28px;color:#cccccc;">
                        Receipt
                    </td>

                    <!-- Organization Name / Date -->
                    <td>
                        <br><br>
                        <strong>To:</strong> {{ $user->email ?: $user->name }}
                        <br>
                        <strong>Date:</strong> {{ $invoice->date()->toFormattedDateString() }}
                    </td>
                </tr>
                <tr valign="top">
                    <!-- Organization Details -->
                    <td style="font-size:9px;">
                        {{ $vendor }}<br>
                        @if (isset($street))
                            {{ $street }}<br>
                        @endif
                        @if (isset($location))
                            {{ $location }}<br>
                        @endif
                        @if (isset($phone))
                            <strong>T</strong> {{ $phone }}<br>
                        @endif
                        @if (isset($url))
                            <a href="{{ $url }}">{{ $url }}</a>
                        @endif
                    </td>
                    <td>
                        <!-- Invoice Info -->
                        <p>
                            <strong>Product:</strong> {{ $product }}<br>
                            <strong>Invoice Number:</strong> {{ $invoice->id }}<br>
                        </p>

                        <!-- Extra / VAT Information -->
                        @if (isset($vat))
                            <p>
                                {{ $vat }}
                            </p>
                        @endif

                        <br><br>

                        <!-- Invoice Table -->
                        <table width="100%" class="table" border="0">
                            <tr>
                                <th align="left">Description</th>
                                <th align="right">Amount</th>
                            </tr>

                            <!-- Display The Invoice Charges -->
                            <tr>
                                <td>
                                    @if ($invoice->planId)
                                        Subscription To "{{ $invoice->planId }}"
                                    @elseif (isset($invoice->customFields['description']))
                                        {{ $invoice->customFields['description'] }}
                                    @else
                                        Charge
                                    @endif
                                </td>

                                <td>{{ $invoice->subtotal() }}</td>
                            </tr>


                            <!-- Display The Discount -->
                            @if ($invoice->hasDiscount())
                                <tr>
                                    <td>Discount ({{ $invoice->coupon() }})</td>
                                    <td>-{{ $invoice->discount() }}</td>
                                </tr>
                            @endif

                            <!-- Display The Final Total -->
                            <tr style="border-top:2px solid #000;">
                                <td style="text-align: right;"><strong>Total</strong></td>
                                <td><strong>{{ $invoice->total() }}</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Invoice;

class InvoiceController extends Controller
{
    public function __construct(){
        //TODO Apply Middleware in to Controller (construct)
        $this->middleware(['subscribed']);
    }

    public function index(){
        //TODO Get User's Invoices
        $invoices = auth()->user()->invoices();
        return view('invoices.index', compact('invoices'));
    }

    public function download(Request $request, $invoiceId){
        //TODO Method for Donwload Invoice
        //TODO $request->user() === auth()->user()
        return auth()->user()->downloadInvoice($invoiceId, [
            'vendor' => 'LaravelPractice4',
            'product' => 'Subscription'
        ]);
    }
}

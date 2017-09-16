<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
	public function __construct()
	{
		$this->middleware(['subscribed']);
	}

	public function index()
	{
		$invoices = auth()->user()->invoices();
		return view('invoices.index', compact('invoices'));
	}

	public function download(Request $request, $invoiceId)
	{
		return $request->user()->downloadInvoice($invoiceId, [
			'vendor'  => 'Cursosdesarrolloweb',
			'product' => 'Suscripción',
		]);
	}
}

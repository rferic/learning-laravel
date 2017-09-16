@extends('templates.template-default')
@section('title', 'Tickets to Laravel Practice1')
@section('content')
	@include('contents.tickets.' . $content)
@endsection
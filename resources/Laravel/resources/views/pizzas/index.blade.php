@extends('layouts.app')

@section('title', 'Pizzas del usuario')

@section('content')

    <div class="container">

        @include('partials.nav')

        <hr />

        @include('partials.flash')

        @forelse($pizzas as $pizza)
            <div class="panel panel-default">
                <div class="panel-heading">{{ $pizza->name }}</div>

                <div class="panel-body">
                    <p>Precio: {{ $pizza->price }}</p>
                    {{ $pizza->description }}
                </div>

                <div class="panel-footer" style="height: 45px;">
                    {{
                        link_to_action(
                            'PizzaController@edit', 'Editar', ['id' => $pizza->id], ['class' => 'col-md-2']
                        )
                    }}

                    @if($pizza->trashed())
                        {!! Form::open(['method' => 'PATCH', 'route' => ['pizzas.restore', $pizza->id]]) !!}
                            {!! Form::submit('Restaurar', ["class" => "btn btn-xs btn-warning col-md-2"]) !!}
                        {!! Form::close() !!}
                    @endif

                    <span class="pull-right">
                        {!! Form::open(['method' => 'DELETE', 'route' => ['pizzas.destroy', $pizza->id]]) !!}
                            {!! Form::submit('Eliminar', ["class" => "btn btn-xs btn-danger"]) !!}
                        {!! Form::close() !!}
                    </span>
                </div>
            </div>
        @empty
            <div class="alert alert-danger">
                No hay pizzas
            </div>
        @endforelse

        @if($pizzas)
            {{ $pizzas->links() }}
        @endif
    </div>

@endsection
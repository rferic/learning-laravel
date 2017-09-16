@extends('layouts.admin')

@section('content')

    @include('partials.flash')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre de la pizza</th>
                <th>Precio de la pizza</th>
                <th>Ingredientes</th>
                <th width="10%">Editar</th>
                <th width="10%">Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->id }}</td>
                    <td>{{ $pizza->name }}</td>
                    <td>{{ $pizza->price }}</td>

                    <td>
                        @if($pizza->ingredients)
                            <?php $arr = [] ?>
                            @foreach($pizza->ingredients as $ingredient)
                                <?php array_push($arr, $ingredient->name) ?>
                            @endforeach
                            <?php echo join(', ', $arr) ?>
                        @endif
                    </td>

                    <td>
                        {{ link_to_action('Admin\IngredientPizzaController@edit', 'Edit pizza ingredient', ["id" => $pizza->id], ["class" => "btn btn-xs btn-info"]) }}
                    </td>

                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.ingredients_pizzas.destroy', $pizza->id]]) !!}
                        {!! Form::submit("Delete pizza ingredient relation", ["class" => "btn btn-xs btn-danger"]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr class="alert alert-danger">
                    <td colspan="6">No hay pizzas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($pizzas)
        {!! $pizzas->links() !!}
    @endif
@endsection
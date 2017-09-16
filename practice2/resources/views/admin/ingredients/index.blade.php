@extends('layouts.admin')

@section('content')

    @include('partials.flash')

    {{ link_to_action('Admin\IngredientController@create', 'Create a Ingredient', [], ['class' => 'btn btn-md btn-success pull-right']) }}
    <br /><hr />

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th width="12%">Edit</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ingredients AS $key => $ingredient)
                <tr>
                    <td>{{ $ingredient->id }}</td>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->price }}</td>
                    <td>{{ link_to_action('Admin\IngredientController@edit', 'Edit ingredient', ['id' => $ingredient->id], ['class' => 'btn btn-sx btn-info']) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Ingredients not found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($ingredients)
        {{ $ingredients->links() }}
    @endif
@endsection

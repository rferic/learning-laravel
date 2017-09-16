<?php

namespace App\Http\Controllers\Admin;

use App\Ingredient;
use App\Pizza;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IngredientPizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::with('ingredients')->paginate(2);
        return view('admin.ingredients_pizzas.index')->withPizzas($pizzas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizza = Pizza::find($id);
        $pizzas = Pizza::pluck('name', 'id');
        $ingredients = Ingredient::pluck('name', 'id');
        return view('admin.ingredients_pizzas.edit', compact('pizza', 'pizzas', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "ingredients" => "required"
        ]);

        $pizza = Pizza::find($id);
        $pizza->ingredients()->sync($request->input("ingredients"));
        return redirect('administration/ingredients_pizzas')->with('message', 'Ingredientes y pizzas actualizados!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        $pizza->ingredients()->detach();
        return redirect('administration/ingredients_pizzas')->with('message', 'Relaciones eliminadas!!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Ingredient;

use App\Pizza;

class IngredientPizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO return view object with objects realtions
        return view('admin.ingredients_pizzas.index')->withPizzas(Pizza::with('ingredients')->paginate(2));
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
        //TODO Get list all objects
        //TODO pluck() => return only params specificate
        $pizzas = Pizza::all()->pluck('name', 'id');
        $ingredients = Ingredient::all()->pluck('name', 'id');
        //TODO compact => take variables with this names and return Array with this variables
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
        $this->validate($request, ['ingredients' => 'required']);
        $pizza = Pizza::find($id);
        //TODO sync() => synchronize relationships (Pizza => Ingredients) - updates relationships (remove and create)
        $pizza->ingredients()->sync($request->input('ingredients'));

        return redirect('admin/ingredients-pizzas')->with('message', 'Ingredients has been updated to Pizza');
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
        //TODO detach() => remove all relationships
        $pizza->ingredients()->detach();

        return redirect('admin/ingredients-pizzas')->with('message', 'Ingredients has been removed to Pizza');
    }
}

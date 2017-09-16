<?php

namespace App\Http\Controllers\Admin;

use App\Ingredient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ingredients.index', [
            "ingredients" => Ingredient::paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredient = new Ingredient;
        return view('administration/ingredients/create')->withIngredient($ingredient);
    }

    /**
     * @param Requests\IngredientRequest $ingredientRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\IngredientRequest $ingredientRequest)
    {
        Ingredient::create($ingredientRequest->input());
        return redirect('administration/ingredients/index')->with('message', 'El ingrediente se ha creado!!');
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
        return view('admin.ingredients.edit', [
            "ingredient" => Ingredient::find($id)
        ]);
    }

    /**
     * @param Requests\IngredientRequest $ingredientRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Requests\IngredientRequest $ingredientRequest, $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->fill($ingredientRequest->all())->save();
        return redirect('administration/ingredients')->with('message', 'Ingrediente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

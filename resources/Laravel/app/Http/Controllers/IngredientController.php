<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;

use App\Http\Requests;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ingredient::all();
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
     * @param Requests\IngredientRequest $ingredientRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Requests\IngredientRequest $ingredientRequest)
    {
        $ingredient = new Ingredient;
        $inserted = $ingredient->create($ingredientRequest->input());
        return response()->json([
            "res" => "El ingrediente con id {$inserted->id} ha sido guardado correctamente"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Ingredient::find($id) ?: [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Requests\IngredientRequest $ingredientRequest
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Requests\IngredientRequest $ingredientRequest, $id)
    {
        $ingredient = Ingredient::find($id);

        $ingredient->fill($ingredientRequest->all())->save();
        return response()->json([
            "res" => "Ingrediente con id {$id} actualizado"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ingredient::destroy($id);
        return response()->json([
            "res" => "Ingrediente con id {$id} eliminado"
        ]);
    }
}

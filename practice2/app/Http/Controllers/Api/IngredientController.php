<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use App\Http\Requests\IngredientRequest;

use App\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO return list items for API
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\IngredientRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(IngredientRequest $ingredientRequest)
    {
        $ingredient = new Ingredient;
        //TODO create element from API & return element inserted
        $inserted = $ingredient->create($ingredientRequest->input());

        //TODO json() convert to JSON
        return response()->json(['response' => 'The ingredient with ID: ' . $inserted->id . ' has been created']);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\IngredientRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(IngredientRequest $ingredientRequest, $id)
    {
        $ingredient = Ingredient::find($id);
        //TODO all() same input()
        $ingredient->fill($ingredientRequest->all())->save();
        return response()->json(['response' => 'Ingredient with ID ' . $id . ' has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        //TODO fisic remove (not logic remove)
        Ingredient::destroy($id);
        return response()->json(['response' => 'Ingredient with ID ' . $id . ' has been removed']);
    }
}

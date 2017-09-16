<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\IngredientRequest;
use App\Ingredient;

class IngredientController extends Controller
{
    public function index(){
        return view('admin.ingredients.index', ['ingredients' => Ingredient::paginate(5)]);
    }

    public function create(){
        //TODO view()->withIngredient() => return View including a Model (Ingredient)
        return view('admin.ingredients.create')->withIngredient(new Ingredient);
    }

    public function store(IngredientRequest $ingredientRequest){ //TODO Use a custom Request
        Ingredient::create($ingredientRequest->input());
        return redirect('admin/ingredients')->with('message', 'Ingredient has been created');
    }

    public function edit($id){
        return view('admin.ingredients.edit', ['ingredient' => Ingredient::find($id)]);
    }

    public function update(IngredientRequest $ingredientRequest, $id){
        $ingredient = Ingredient::find($id);
        $ingredient->fill($ingredientRequest->all())->save();
        return redirect('admin/ingredients')->with('message', 'Ingredient has been updated');
    }
}

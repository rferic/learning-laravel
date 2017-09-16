<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('ingredients.index', [
            'ingredients' => Ingredient::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredients.create', ['ingredient' => new Ingredient]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:ingredients|max:255',
                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'name.max' => 'Name can\'t contain more than 255 characters',
                'price.required' => 'Price is required',
                'price.regex' => 'Price is incorrect'
            ]
        );

        Ingredient::create($request->input());
        return redirect('ingredients')->with('message', 'Ingredient has been created');
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
        return view('ingredients.edit', ['ingredient' => Ingredient::findOrFail($id)]);
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
        $this->validate(
            $request,
            [
                'name' => 'required|max:255|unique:ingredients,name,' . $id, //TODO compare name and id if is equal validate OK else KO
                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'name.max' => 'Name can\'t contain more than 255 characters',
                'price.required' => 'Price is required',
                'price.regex' => 'Price is incorrect'
            ]
        );

        $ingredient = Ingredient::find($id);
        $ingredient->fill($request->all())->save();

        return redirect('ingredients')->with('message', 'Ingredient has been updated');
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
        return redirect('ingredients')->with('message', 'Ingredient has been removed');
    }
}

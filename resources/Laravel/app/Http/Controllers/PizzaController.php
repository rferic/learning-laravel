<?php

namespace App\Http\Controllers;

use App\Pizza;
use Illuminate\Http\Request;

use App\Http\Requests;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pizzas.index",
            [
                "pizzas" => Pizza::withTrashed()->where('user_id', auth()->user()->id)->paginate(2)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pizza = new Pizza;
        return view('pizzas.create', ['pizza' => $pizza]);
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
               'name' => 'required|unique:pizzas|max:255',
               'price'=> 'required',
               'description' => 'required'
           ],
           [
               'name.required' => 'El nombre de la pizza es requerido',
               'name.unique' => 'Esa pizza ya existe!',
               'price.required' => 'El precio de la pizza es requerido',
               'description.required' => 'La descripción de la pizza es requerida'
           ]
        );

        Pizza::create($request->input());
        return redirect('pizzas')->with('message', 'Pizza creada!!');
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
        $pizza = Pizza::findOrFail($id);
        return view('pizzas.edit', ['pizza' => $pizza]);
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
                'name' => "required|max:255|unique:pizzas,name,{$request->input('id')}",
                'price'=> 'required',
                'description' => 'required'
            ],
            [
                'name.required' => 'El nombre de la pizza es requerido',
                'name.unique' => 'Esa pizza ya existe!',
                'price.required' => 'El precio de la pizza es requerido',
                'description.required' => 'La descripción de la pizza es requerida'
            ]
        );

        $pizza = Pizza::find($id);
        $pizza->fill($request->all())->save();
        return redirect('pizzas')->with('message', 'Pizza actualizada!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pizza::destroy($id);
        return redirect('pizzas')->with('message', 'Pizza eliminada!!');
    }

    public function restore($id)
    {
        Pizza::withTrashed()->find($id)->restore();
        return redirect('pizzas')->with('message', 'Pizza restaurada!!');
    }
}

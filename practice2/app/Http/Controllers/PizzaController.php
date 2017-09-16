<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Queue\FailingJob;
use App\Pizza;

class PizzaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view('pizzas.index', [
            //TODO return list pizzas of user login (including trashed pizzas) and paginate the results
            'pizzas' => Pizza::withTrashed()->where('user_id', auth()->user()->id)->paginate(2)
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //TODO send Model for in view render ViewModelForm (auto generate)
        return view('pizzas.create', ['pizza' => new Pizza]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //TODO validate Form to create ($request, $rules, $messages)
        $this->validate(
            $request,
            [
                'name' => 'required|unique:pizzas|max:255',
                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'description' => 'required'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'name.max' => 'Name can\'t contain more than 255 characters',
                'price.required' => 'Price is required',
                'price.regex' => 'Price is incorrect',
                'description.required' => 'Description is required'
            ]
        );

        //TODO insert params with Eloquent ORM
        Pizza::create($request->input());

        //TODO redirect page with message
        return redirect('pizzas')->with('message', 'Pizza has been created');
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
        //TODO get Object but if id is incorrect return Fail
        //TODO in case we want no return fail replace findOrFail for find
        return view('pizzas.edit', ['pizza' => Pizza::findOrFail($id)]);
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
        //TODO validate Form to update ($request, $rules, $messages)
        $this->validate(
            $request,
            [
                'name' => 'required|max:255|unique:pizzas,name,' . $id, //TODO compare name and id if is equal validate OK else KO
                'price' => 'required|regex:/^\d*(\.\d{1,2})?$/',
                'description' => 'required'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'name.max' => 'Name can\'t contain more than 255 characters',
                'price.required' => 'Price is required',
                'price.regex' => 'Price is incorrect',
                'description.required' => 'Description is required'
            ]
        );

        //TODO get object (Pizza)
        $pizza = Pizza::find($id);

        //TODO update params and update with Eloquent ORM
        $pizza->fill($request->all())->save();

        //TODO redirect page with message
        return redirect('pizzas')->with('message', 'Pizza has been updated');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //TODO logic remove pizza
        Pizza::destroy($id);
        return redirect('pizzas')->with('message', 'Pizza has been removed');
    }

    public function restore($id){
        //TODO logic restore pizza state
        Pizza::withTrashed()->find($id)->restore();
        return redirect('pizzas')->with('message', 'Pizza has been restored');
    }
}

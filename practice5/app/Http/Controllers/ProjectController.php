<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

use App\Project;

use App\Transformers\ProjectTransformer;

class ProjectController extends Controller
{
    //TODO Declare for use Fractal
    protected $fractal;

    //TODO Construct required for Fractal
    public function __construct(Manager $fractal){
        $this->fractal = $fractal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO get list elements
        $projects = Project::all();

        //TODO Create a Collection with Transformer
        $resource = new Collection($projects, new ProjectTransformer);

        //TODO Manipulate with Fractal
        $data = $this->fractal->createData($resource);

        //TODO return how Array
        return response()->json($data->toArray());
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
        //TODO get element
        $project = Project::find($id);

        //TODO Create a Item with Transformer
        $resource = new Item($project, new ProjectTransformer);

        //TODO Manipulate with Fractal
        $data = $this->fractal->createData($resource);

        //TODO return item
        return response()->json($data->toArray());
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

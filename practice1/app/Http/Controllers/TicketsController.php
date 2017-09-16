<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use App\Ticket;
use Illuminate\Support\Facades\Mail;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {		
        return view('pages/tickets', Array(
			'view' => 'tickets',
			'content' => 'list',
			'tickets' => Ticket::all()
		));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/tickets', Array(
			'view' => 'tickets',
			'content' => 'create'
		));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $slug = uniqid();
		$ticket = new Ticket(array(
			'title' => $request->get('title'),
			'content' => $request->get('content'),
			'slug' => $slug
		));
		
		$ticket->save();
		
		Mail::send('emails.ticket', Array('ticket' => $slug), function($message){
			$message->from('multimediospower@gmail.com');
			$message->to('multimediospower@gmail.com')->subject('New ticket has been created');
		});
		
		return redirect('/tickets')->with('status', 'Your ticker has been created. The ID ticket is ' . $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if($slug === 'create')
			return $this->create();
		else{
			$ticket = Ticket::whereSlug($slug)->firstOrFail();
			
			return view('pages/tickets', Array(
				'view' => 'tickets',
				'content' => 'show',
				'ticket' => $ticket,
				'comments' => $ticket->comments()->get()
			));
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('pages/tickets', Array(
			'view' => 'tickets',
			'content' => 'edit',
			'ticket' => Ticket::whereSlug($slug)->firstOrFail()
		));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
		$ticket->title = $request->get('title');
		$ticket->content = $request->get('content');		
		$ticket->status = is_null($request->get('status')) ? 1 : 0;
		
		$ticket->save();
		
		return redirect(action('TicketsController@show', $ticket->slug))->with('status', 'Ticker ' . $slug . ' has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();		
		$ticket->delete();
		
		return redirect(action('TicketsController@index'))->with('status', 'Ticker ' . $slug . ' has been removed');
    }
}

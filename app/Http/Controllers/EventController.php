<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateEvent;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;


class EventController extends Controller
{
    
    public function index() {

        $search = request('search');

        if($search){

            $events = Event::where([
                ['title', 'like', '%'.$search.'%'],
            ])->get();

        }  else {
            $events = Event::all();
        }


        return view('welcome',['events' => $events, 'search' => $search]);

    }

    public function create() {
        return view('events.create');
    }


    public function store(StoreUpdateEvent $request){
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->empresa = $request->empresa;
        $event->description = $request->description;
        $event->private = $request->private;
        $event->items = $request->items;


        //image Upload

        if ($request->hasFile('image') && $request->file('image')->isValid()){

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }


        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/dashboard')->with('msg', 'Solicitação Enviada com Sucesso!');
    }


    public function show($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){

            $userEvents = $user->eventsAsAdmin->toArray();

            foreach($userEvents as $userEvents){
                if($userEvents['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show',['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);

    }


    public function dashboard() {
        $user = auth()->user();

        $events = $user->events;

        $eventsAsAdmin = $user->eventsAsAdmin;

        return view('events.dashboard',
            ['events' => $events, 'eventsAsAdmin' =>$eventsAsAdmin]);
    }


    public function destroy($id) {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Solicitação Deletada com Sucesso!');
    }


    public function edit($id) {

        $event = Event::findOrFail($id);

        return view('events.edit',['event' => $event]);
    }


    public function update(Request $request){

        $data = $request->all();

                //image Upload

                if ($request->hasFile('image') && $request->file('image')->isValid()){

                    $requestImage = $request->image;
        
                    $extension = $requestImage->extension();
        
                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
                    $requestImage->move(public_path('img/events'), $imageName);
        
                    $data['image'] = $imageName;
        
                }
             
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Solicitação Editada com Sucesso!');
    }


    public function joinSolicitacao($id){

        $user = auth()->user();

        $user->eventsAsAdmin()->attach($id);

        $event = Event::findOrFail($id);

        return back()->with('msg', 'Começado com sucesso ' . $event->title);


    }


    public function leaveSolicitacao($id){

        $user = auth()->user();

        $user->eventsAsAdmin()->detach($id);

        $event = Event::findOrFail($id);

        return back()->with('msg', 'Saiu com sucesso ' . $event->title);
    }
}
<?php

namespace App\Http\Controllers\Backend;

use App\Models\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request)
    {
  
        if($request->ajax()) {
       
             $data = Calendar::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
  
             return response()->json($data);
        }
  
        return view('backend.event.all_event ');
    }
 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request)
    {
 
        switch ($request->type) {
           case 'add':
              $event = Calendar::create([
                  'title' => $request->title,
                  'description' => $request->description,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'update':
              $event = Calendar::find($request->id)->update([
                  'title' => $request->title,
                  'description' => $request->description,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = Calendar::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # code...
             break;
        }
    }
    public function updateEvent(Request $request)
{
    // Get the event details from the request
    $eventId = $request->input('id');
    $title = $request->input('title');
    $start = $request->input('start');
    $end = $request->input('end');

    // Update the event in your database using the event ID
    // You can use your own database update logic here
    $event = Calendar::find($eventId);
    $event->title = $title;
    $event->start = $start;
    $event->end = $end;
    $event->save();

    return response()->json(['status' => 'success']);
}
}

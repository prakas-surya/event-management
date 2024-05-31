<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Exceptions;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('Event/index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Event/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'title' => 'required|max:255|min:3',
                'description' => 'nullable|max:255|min:5',
                'date' => 'required|date',
                'location' => 'required|max:255|min:5',
                'status' => 'required|in:completed,pending',
            ]);

            Event::create($data);
            DB::commit();

            return response()->json(['status' => 'Success']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 'Failure', 'errors' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        return view('Event/edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validate([
                'title' => 'required|max:255|min:3',
                'description' => 'nullable|max:255|min:5',
                'date' => 'required|date',
                'location' => 'required|max:255|min:5',
                'status' => 'required|in:completed,pending',
            ]);

            $event = Event::find($id);

            $event->update($data);

            DB::commit();

            return response()->json(['status' => 'Success']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => 'Failure', 'errors' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::destroy($id);
       return to_route('events.index');
    }
}

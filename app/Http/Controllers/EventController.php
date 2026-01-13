<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::query()
            ->where('event_date', '>=', Carbon::now())
            ->orderBy('event_date')
            ->get();

        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Event::create($validated);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event added successfully!');
    }
}

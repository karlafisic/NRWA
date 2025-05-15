<?php

namespace App\Http\Controllers;
use App\Models\Actor;
use App\Models\Film;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $actors = Actor::all();
        return view('actors.index', compact('actors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $films = Film::all(); // dodano

        return view('actors.create', compact('films'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'films' => 'required|array',
            'films.*' => 'exists:film,film_id'
        ]);

        $actor = Actor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'last_update' => Carbon::now(),
        ]);

        if ($actor) {
            $actor->films()->sync($request->films);
        } else {
            return redirect()->back()->with('error', 'Actor could not be created.');
        }
        return redirect('/actors')->with('success', 'Actor created successfully.');

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
        //
        $actor = Actor::findOrFail($id);
        $films = Film::all();

        return view('actors.edit', compact('actor', 'films'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $actor = Actor::findOrFail($id);
        $actor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'last_update' => Carbon::now()
        ]);
        if ($actor) {
            $actor->films()->sync($request->films);
        } else {
            return redirect()->back()->with('error', 'Actor could not be created.');
        }

        return redirect('/actors')->with('success', 'Actor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $actor = Actor::findOrFail($id);
        $actor->films()->detach();
        $actor->delete();

        return redirect('/actors')->with('success', 'Actor deleted successfully.');
    }
}

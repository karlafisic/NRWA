<?php

namespace App\Http\Controllers;
use App\Models\Film;
use App\Models\Language;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $languages = Language::all();
        $categories = Category::all(); 

        return view('films.create', compact('languages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'language_id' => 'required|integer|exists:language,language_id',
            'original_language_id' => 'nullable|exists:language,language_id',
            'release_year' => 'required|integer|min:1900|max:'.date('Y'),
            'rental_duration' => 'required|integer',
            'rental_rate' => 'required|numeric',
            'replacement_cost' => 'required|numeric',
            'rating' => 'nullable|string|max:255',
            'special_features' => 'nullable|string|max:255',
            'categories' => 'required|array',
            'categories.*' => 'exists:category,category_id'
        ]);
        $film = Film::create([
            'title' => $request->title,
            'description' => $request->description,
            'release_year' => $request->release_year,
            'language_id' => $request->language_id,
            'original_language_id' => $request->original_language_id,
            'rental_duration' => $request->rental_duration,
            'rental_rate' => $request->rental_rate,
            'length' => $request->length,
            'replacement_cost' => $request->replacement_cost,
            'rating' => $request->rating,
            'special_features' => $request->special_features,
            'last_update' => now(), 
        ]);
        if ($film) {
            $film->categories()->sync($request->categories);
        } else {
            return redirect()->back()->with('error', 'Film could not be created.');
        }

        return redirect('/films')->with('success', 'Film created successfully.');

    }

    /**
     * Display the specified resource.
     */
    /**
 * Display the specified resource.
 */
    public function show(string $id)
    {
        $film = Film::with(['language', 'originalLanguage', 'categories'])
                ->findOrFail($id);
        
        return view('films.show', compact('film'));
    }

    public function dohvati(string $id)
    {
        $film = Film::with(['language', 'originalLanguage', 'categories'])
                    ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $film->id,
                'title' => $film->title,
                'description' => $film->description,
                'release_year' => $film->release_year,
                'language' => $film->language,
                'original_language' => $film->originalLanguage,
                'rental_duration' => $film->rental_duration,
                'rental_rate' => $film->rental_rate,
                'length' => $film->length,
                'replacement_cost' => $film->replacement_cost,
                'rating' => $film->rating,
                'special_features' => $film->special_features,
                'last_update' => $film->last_update,
                'categories' => $film->categories
            ]
        ], 200, [], JSON_PRETTY_PRINT);
    }


    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $film = Film::findOrFail($id);
        $languages = Language::all(); // Lista jezika za dropdown u formi
        $categories = Category::all();

    
        // Prikazivanje forme za uređivanje s podacima filma
        return view('films.edit', compact('film', 'languages', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validacija podataka
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'release_year' => 'required|integer',
        'language_id' => 'required|exists:language,language_id',
        'original_language_id' => 'required|exists:language,language_id',
        'rental_duration' => 'required|integer',
        'rental_rate' => 'required|numeric',
        'length' => 'nullable|integer',
        'replacement_cost' => 'required|numeric',
        'rating' => 'nullable|string|max:5',
        'special_features' => 'nullable|string',
        'categories' => 'required|array',
        'categories.*' => 'exists:category,category_id'
    ]);

    // Pronađite film prema ID-u
    $film = Film::findOrFail($id);

    // Ažurirajte film s novim podacima
    $film->update([
        'title' => $request->title,
        'description' => $request->description,
        'release_year' => $request->release_year,
        'language_id' => $request->language_id,
        'original_language_id' => $request->original_language_id,
        'rental_duration' => $request->rental_duration,
        'rental_rate' => $request->rental_rate,
        'length' => $request->length,
        'replacement_cost' => $request->replacement_cost,
        'rating' => $request->rating,
        'special_features' => $request->special_features,
        'last_update' => Carbon::now(),  // postavite datum zadnje izmjene
    ]);
    if ($film) {
        $film->categories()->sync($request->categories);
    } else {
        return redirect()->back()->with('error', 'Film could not be created.');
    }

    // Redirektanje na index stranicu s porukom o uspješnom ažuriranju
    return redirect('/films')->with('success', 'Film updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $film = Film::findOrFail($id);

    // Brisanje filma
        $film->delete();

    // Redirektanje na index stranicu s porukom o uspješnom brisanju
        return redirect('/films')->with('success', 'Film deleted successfully.');
    }
}

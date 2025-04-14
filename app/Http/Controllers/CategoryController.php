<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
        ]);
    
        // Dodavanje trenutnog vremena za 'last_update'
        $categoryData = $request->all();
        $categoryData['last_update'] = now(); // Laravel funkcija za trenutni datum i vrijeme
    
        // Spremanje nove kategorije
        Category::create($categoryData);
    
        // Preusmjeravanje na popis kategorija
        return redirect()->route('categories.index');
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
        $category = Category::findOrFail($id);
    
        // Return the 'edit' view with the category data
        return view('categories.edit', compact('category'));

    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
        'name' => 'required|max:255',
    ]);

    // Find the category by ID
        $category = Category::findOrFail($id);

    // Update the category with the new data
        $category->update($request->all());

    // Redirect back to the category list
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories')->with('success', 'Product Data is successfully deleted');

    }
}

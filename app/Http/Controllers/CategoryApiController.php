<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryApiController extends Controller
{
    /**
     * Dohvati sve kategorije
     *
     * Vraća listu svih kategorija iz baze podataka.
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "name": "Animirani",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-05-01T12:34:56.000000Z"
     *   }
     * ]
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Dodaj novu kategoriju
     *
     * Sprema novu kategoriju u bazu podataka.
     *
     * @bodyParam name string required Naziv kategorije. Example: Sportska
     *
     * @response 201 {
     *   "message": "Category created successfully",
     *   "category": {
     *     "id": 2,
     *     "name": "Sportska",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-05-01T12:34:56.000000Z"
     *   }
     * }
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ], 201);
    }

    /**
     * Dohvati određenu kategoriju
     *
     * Dohvaća kategoriju po ID-u.
     *
     * @urlParam id integer required ID kategorije. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "Dječja",
     *   "created_at": "2024-05-01T12:34:56.000000Z",
     *   "updated_at": "2024-05-01T12:34:56.000000Z"
     * }
     *
     * @response 404 {
     *   "message": "Category not found"
     * }
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if (!empty($category)) {
            return response()->json($category);
        } else {
            return response()->json([
                "message" => "Category not found"
            ], 404);
        }
    }

    /**
     * Ažuriraj kategoriju
     *
     * Ažurira naziv postojeće kategorije.
     *
     * @urlParam id integer required ID kategorije. Example: 1
     * @bodyParam name string required Novi naziv kategorije. Example: Znanstveno fantastična
     *
     * @response 200 {
     *   "message": "Category updated successfully",
     *   "category": {
     *     "id": 1,
     *     "name": "Znanstveno fantastična",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-06-01T15:00:00.000000Z"
     *   }
     * }
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }

    /**
     * Obriši kategoriju
     *
     * Briše kategoriju iz baze podataka prema ID-u.
     *
     * @urlParam id integer required ID kategorije. Example: 1
     *
     * @response 200 {
     *   "message": "Category deleted successfully"
     * }
     *
     * @response 404 {
     *   "status": "ERROR",
     *   "message": "404 not found",
     *   "description": "No query results for model [App\\Models\\Category] 999",
     *   "code": 0
     * }
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response([
                'status' => 'ERROR',
                'message' => '404 not found',
                'description' => $e->getMessage(),
                'code' => $e->getCode()
            ], 404);
        }
    }
}

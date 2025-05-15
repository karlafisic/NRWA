<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories=Category::all();
		return response()->json($categories);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $category = Category::create($request->all());
        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

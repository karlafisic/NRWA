<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryApiController extends Controller
{
    /**
     * Dohvati sve države
     *
     * Vraća listu svih država iz baze podataka.
     *
     * @response 200 [
     *   {
     *     "id": 1,
     *     "country": "Hrvatska",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-05-01T12:34:56.000000Z"
     *   }
     * ]
     */
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    /**
     * Dodaj novu državu
     *
     * Sprema novu državu u bazu podataka.
     *
     * @bodyParam country string required Naziv države. Example: Njemačka
     *
     * @response 201 {
     *   "message": "Country created successfully",
     *   "country": {
     *     "id": 2,
     *     "country": "Njemačka",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-05-01T12:34:56.000000Z"
     *   }
     * }
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'country' => 'required|string|max:255',
        ]);

        $country = Country::create($validatedData);

        return response()->json([
            'message' => 'Country created successfully',
            'country' => $country
        ], 201);
    }

    /**
     * Dohvati određenu državu
     *
     * Dohvaća podatke o državi prema ID-u.
     *
     * @urlParam id integer required ID države. Example: 1
     *
     * @response 200 {
     *   "id": 1,
     *   "country": "Hrvatska",
     *   "created_at": "2024-05-01T12:34:56.000000Z",
     *   "updated_at": "2024-05-01T12:34:56.000000Z"
     * }
     *
     * @response 404 {
     *   "message": "Country not found"
     * }
     */
    public function show(string $id)
    {
        $country = Country::find($id);
        if ($country) {
            return response()->json($country);
        } else {
            return response()->json([
                'message' => 'Country not found'
            ], 404);
        }
    }

    /**
     * Ažuriraj državu
     *
     * Ažurira podatke o postojećoj državi prema ID-u.
     *
     * @urlParam id integer required ID države. Example: 1
     * @bodyParam country string required Novi naziv države. Example: Austrija
     *
     * @response 200 {
     *   "message": "Country updated successfully",
     *   "country": {
     *     "id": 1,
     *     "country": "Austrija",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-06-01T14:12:00.000000Z"
     *   }
     * }
     *
     * @response 404 {
     *   "message": "Country not found",
     *   "description": "No query results for model [App\\Models\\Country] 999"
     * }
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'country' => 'required|string|max:255',
        ]);

        try {
            $country = Country::findOrFail($id);
            $country->update($validatedData);

            return response()->json([
                'message' => 'Country updated successfully',
                'country' => $country
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Country not found',
                'description' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Obriši državu
     *
     * Briše državu iz baze prema ID-u.
     *
     * @urlParam id integer required ID države. Example: 1
     *
     * @response 200 {
     *   "message": "Country deleted successfully"
     * }
     *
     * @response 404 {
     *   "message": "Country not found",
     *   "description": "No query results for model [App\\Models\\Country] 999"
     * }
     */
    public function destroy(string $id)
    {
        try {
            $country = Country::findOrFail($id);
            $country->delete();

            return response()->json([
                'message' => 'Country deleted successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Country not found',
                'description' => $e->getMessage()
            ], 404);
        }
    }
}

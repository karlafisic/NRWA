<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageApiController extends Controller
{
    /**
     * @group Languages
     * 
     * Dohvati sve jezike
     * 
     * Ova ruta vraća popis svih jezika u sustavu.
     * 
     * @response 200 [
     *   {
     *     "id": 1,
     *     "name": "Hrvatski",
     *     "created_at": "2024-05-01T12:34:56.000000Z",
     *     "updated_at": "2024-05-01T12:34:56.000000Z"
     *   }
     * ]
     */
    public function index()
    {
        return Language::all();
    }

    /**
     * @group Languages
     * 
     * Dohvati jedan jezik
     * 
     * Vraća podatke o jeziku prema zadanom ID-u.
     * 
     * @urlParam id integer required ID jezika. Primjer: 1
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "Engleski",
     *   "created_at": "2024-05-01T12:34:56.000000Z",
     *   "updated_at": "2024-05-01T12:34:56.000000Z"
     * }
     * 
     * @response 404 {
     *   "message": "Language not found."
     * }
     */
    public function show($id)
    {
        $language = Language::find($id);
        if (!$language) {
            return response()->json(['message' => 'Language not found.'], 404);
        }
        return $language;
    }

    /**
     * @group Languages
     * 
     * Dodaj novi jezik
     * 
     * Kreira novi jezik u sustavu.
     * 
     * @bodyParam name string required Naziv jezika. Primjer: Njemački
     * 
     * @response 201 {
     *   "id": 2,
     *   "name": "Njemački",
     *   "created_at": "2024-05-01T12:34:56.000000Z",
     *   "updated_at": "2024-05-01T12:34:56.000000Z"
     * }
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language = Language::create($request->only('name'));
        return response()->json($language, 201);
    }

    /**
     * @group Languages
     * 
     * Ažuriraj postojeći jezik
     * 
     * Ažurira podatke o jeziku s navedenim ID-em.
     * 
     * @urlParam id integer required ID jezika koji se ažurira. Primjer: 1
     * 
     * @bodyParam name string required Novi naziv jezika. Primjer: Talijanski
     * 
     * @response 200 {
     *   "id": 1,
     *   "name": "Talijanski",
     *   "created_at": "2024-05-01T12:34:56.000000Z",
     *   "updated_at": "2024-05-02T10:22:11.000000Z"
     * }
     * 
     * @response 404 {
     *   "message": "Language not found."
     * }
     */
    public function update(Request $request, $id)
    {
        $language = Language::find($id);
        if (!$language) {
            return response()->json(['message' => 'Language not found.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $language->update($request->only('name'));
        return $language;
    }

    /**
     * @group Languages
     * 
     * Obriši jezik
     * 
     * Briše jezik s određenim ID-em.
     * 
     * @urlParam id integer required ID jezika koji se briše. Primjer: 1
     * 
     * @response 204 {
     *   "message": "Language deleted successfully"
     * }
     * 
     * @response 404 {
     *   "message": "Language not found."
     * }
     */
    public function destroy($id)
    {
        $language = Language::find($id);
        if (!$language) {
            return response()->json(['message' => 'Language not found.'], 404);
        }

        $language->delete();
        return response()->json(['message' => 'Language deleted successfully'], 204);
    }
}

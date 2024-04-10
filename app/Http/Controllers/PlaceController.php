<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/places",
     *     tags={"Places"},
     *     summary="Lista todos os lugares",
     *     description="Obtém uma lista de todos os lugares.",
     *     @OA\Response(response="200", description="Sucesso"),
     * )
     */
    public function index(Request $request)
    {
        $places = Place::paginate(10);

        $searchable = ['name', 'slug', 'city', 'state'];
        $queryParam = $request->query();

        if($queryParam && in_array(key($queryParam), $searchable)) {
            $key = key($queryParam);
            $places = Place::where($key, 'ILIKE', '%'. $queryParam[$key] . '%')->paginate(10);
        }

        return response()->json($places);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'city' => 'required',
            'state' => 'required'
        ]);

        $place = Place::create($validate);

        return response()->json($place, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $place = Place::findOrFail($id);

        return response()->json($place);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $place = Place::findOrFail($id);

        $validate = $request->validate([
            'name' => 'string',
            'slug' => 'string',
            'city' => 'string',
            'state' => 'string'
        ]);

        $place->update($validate);

        return response()->json($place);
    }
}

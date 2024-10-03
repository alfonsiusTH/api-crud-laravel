<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaterialCategoriesResource;
use App\Models\Material;
use App\Models\Material_Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialCategoriesController extends Controller
{
    public function index() {
        $materialCategories = Material_Categories::all();
        return MaterialCategoriesResource::collection($materialCategories->loadMissing(['authorId:id']));
    }

    public function detail($id) {
        $materialCategories = Material_Categories::findOrFail($id);
        return new MaterialCategoriesResource($materialCategories->loadMissing(['authorId:id']));
    }

    public function store(Request $request) {
        $validated = $request -> validate([
            "nama" => "required|string",
            "description" => "required|string",
        ]);

        $validated['author'] = Auth::id();

        $materialCategories = Material_Categories::create($validated);
        return new MaterialCategoriesResource($materialCategories->loadMissing(['authorId:id']));
    }

    public function update(Request $request, $id){
        $validated = $request -> validate([
            "nama" => "required|string",
            "description" => "required|string",
        ]);

        $materialCategories = Material_Categories::findOrFail($id);
        $materialCategories->update($request->all());

        return new MaterialCategoriesResource(($materialCategories->loadMissing(['authorId:id'])));
    }

    public function destroy($id) {
        $materialCategories = Material_Categories::findOrFail($id);
        $materialCategories->delete();

        return new MaterialCategoriesResource($materialCategories->loadMissing(['authorId:id']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Material_Categories;

use Illuminate\Support\Facades\Log;
use function Laravel\Prompts\select;
use App\Http\Resources\MaterialResource;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        // $material = Material::all();
        // return MaterialResource::collection($material);

        // $material = Material::select('material.*', 'material_categories.name as material_categories_name')
        // ->join('material_categories', 'material.material_categories_id', '=', 'material_categories.id')
        // ->get();

        // return MaterialResource::collection($material);

        $material = Material::with('categories')->get();
        return MaterialResource::collection($material);
    }

    public function detail($id)
    {
        $material = Material::findOrFail($id);
        return new MaterialResource($material->loadMissing("userId:id"));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            "material_categories_id" => "required|exists:material_categories,id",
            "code" => "required|string",
            "name" => "required|string",
            "brand" => "required|string",
            "expired_date" => "required|date",
            "is_toxic" => "required|boolean",
        ]);

        // $categories = Material_Categories::first();
        // $validate['material_categories_id'] = $categories->id;

        $validate['user_id'] = Auth::id();
        // dd(Auth::user()->id);
        $validate['material_categories_id'] = $request->material_categories_id;

        $material = Material::create($validate);

        return new MaterialResource($material->loadMissing("userId:id"));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            "material_categories_id" => "required|exists:material_categories,id",
            "code" => "required|string",
            "name" => "required|string",
            "brand" => "required|string",
            "expired_date" => "required|date",
            "is_toxic" => "required|boolean",
        ]);

        $material = Material::findOrFail($id);
        $material->update($validate);

        return new MaterialResource($material->loadMissing("userId:id"));
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        // $materialCategoriesId = $material->material_categories_id;

        $material->delete();

        // if ($materialCategoriesId) {
        //     $materialCategories = Material_Categories::find($materialCategoriesId);
        //     if ($materialCategories) {
        //         $materialCategories->delete();
        //     }
        // }

        return new MaterialResource($material->loadMissing(['userId:id']));
    }
}

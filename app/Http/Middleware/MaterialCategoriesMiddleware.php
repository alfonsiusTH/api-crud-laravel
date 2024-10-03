<?php

namespace App\Http\Middleware;

use App\Models\Material_Categories;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterialCategoriesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();
        $materialCategories = Material_Categories::findOrFail($request->id);

        if ($materialCategories->author != $user->id){
            return response()->json(["message" => "data not found"], 404);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MaterialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = auth('sanctum')->user();
        $material = Material::findOrFail($request->id);

        if($material->user_id != $currentUser->id){
            return response()->json(['message' => "data not found"], 404);
        }
        return $next($request);
    }
}

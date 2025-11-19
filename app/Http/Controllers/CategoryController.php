<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::withCount('gigs')->get();

        return response()->json([
            'data' => CategoryResource::collection($categories)
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        $category->load('gigs.seller');

        return response()->json([
            'data' => new CategoryResource($category)
        ]);
    }
}
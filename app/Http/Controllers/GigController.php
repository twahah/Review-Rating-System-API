<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Http\Resources\GigResource;
use App\Http\Requests\StoreGigRequest;
use App\Http\Requests\UpdateGigRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GigController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Gig::with(['category', 'seller'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('seller_id')) {
            $query->where('seller_id', $request->seller_id);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('active_only', true)) {
            $query->where('is_active', true);
        }

        $gigs = $query->latest()->paginate(10);

        return response()->json([
            'data' => GigResource::collection($gigs),
            'meta' => [
                'current_page' => $gigs->currentPage(),
                'last_page' => $gigs->lastPage(),
                'per_page' => $gigs->perPage(),
                'total' => $gigs->total(),
            ]
        ]);
    }

    public function store(StoreGigRequest $request): JsonResponse
    {
        $gig = Gig::create($request->validated());

        return response()->json([
            'message' => 'Gig created successfully',
            'data' => new GigResource($gig->load(['category', 'seller']))
        ], 201);
    }

    public function show(Gig $gig): JsonResponse
    {
        $gig->load(['category', 'seller', 'reviews.user']);

        return response()->json([
            'data' => new GigResource($gig)
        ]);
    }

    public function update(UpdateGigRequest $request, Gig $gig): JsonResponse
    {
        $gig->update($request->validated());

        return response()->json([
            'message' => 'Gig updated successfully',
            'data' => new GigResource($gig->load(['category', 'seller']))
        ]);
    }

    public function destroy(Gig $gig): JsonResponse
    {
        $gig->delete();

        return response()->json([
            'message' => 'Gig deleted successfully'
        ]);
    }
}
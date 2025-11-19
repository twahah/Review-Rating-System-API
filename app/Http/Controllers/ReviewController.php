<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Review;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function index(Gig $gig): JsonResponse
    {
        $reviews = $gig->reviews()
            ->with(['user', 'gig'])
            ->latest()
            ->paginate(10);

        return response()->json([
            'data' => ReviewResource::collection($reviews),
            'meta' => [
                'current_page' => $reviews->currentPage(),
                'last_page' => $reviews->lastPage(),
                'per_page' => $reviews->perPage(),
                'total' => $reviews->total(),
            ]
        ]);
    }

    public function store(StoreReviewRequest $request, Gig $gig): JsonResponse
    {
        // Check if user already reviewed this gig
        $existingReview = Review::where('gig_id', $gig->id)
            ->where('user_id', auth()->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'message' => 'You have already reviewed this gig'
            ], 422);
        }

        $review = Review::create([
            ...$request->validated(),
            'gig_id' => $gig->id,
            'user_id' => auth()->id,
        ]);

        return response()->json([
            'message' => 'Review created successfully',
            'data' => new ReviewResource($review->load(['user', 'gig']))
        ], 201);
    }

    public function update(UpdateReviewRequest $request, Review $review): JsonResponse
    {
        // $this->authorize('update', $review);

        $review->update($request->validated());

        return response()->json([
            'message' => 'Review updated successfully',
            'data' => new ReviewResource($review->load(['user', 'gig']))
        ]);
    }

    public function destroy(Review $review): JsonResponse
    {
        // $this->authorize('delete', $review);

        $review->delete();

        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
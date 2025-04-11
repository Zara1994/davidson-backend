<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        try {
            $reviews = Review::all();

            if ($reviews->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No reviews found',
                    'data' => $reviews,
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'data' => $reviews
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

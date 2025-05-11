<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        try {
            $categories = Advertisement::all();

            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No categories found',
                    'data' => $categories,
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'data' => $categories
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

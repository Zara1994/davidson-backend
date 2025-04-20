<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index($categoryId)
    {
        try {
            $query = Product::where('category_id', $categoryId);

            // Поиск по имени, если передан ?search=что-то
            if (request()->has('search')) {
                $search = request()->query('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
            }

            $products = $query->get();

            if ($products->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No products found',
                    'data' => $products
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'data' => $products
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getByCategory($id)
    {
        $products = Product::where('category_id', $id)->get();

        return response()->json($products);
    }
}

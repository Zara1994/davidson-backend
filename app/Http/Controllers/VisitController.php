<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Валидация входных данных
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:20', // можно заменить на regex
                'visit_date' => 'required|date|after_or_equal:today',
                'visit_time' => 'required|array',
                'visit_time.*' => 'in:all_day,morning,afternoon,evening',
                ]);

            // Сохранение нового сообщения
            $visit = Visit::create($validated);

            // Возвращаем отформатированный контакт
            return response()->json([
                'status' => 'success',
                'message' => 'Your message has been received! We will get back to you soon.',
                'data' => $visit
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

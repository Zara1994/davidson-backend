<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $projects = Project::all();

            if ($projects->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No projects found',
                    'data' => $projects,
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'data' => $projects
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка сервера',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

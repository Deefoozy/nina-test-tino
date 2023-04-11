<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(): JsonResponse
    {
        $users = User::all();

        return response()->json(['data' => $users]);
    }

    public function get(int $id): JsonResponse {
        // Replace generated view with json response
        $user = User::FindOrFail($id);
        $user->load('languages');
        $user->load('allergies');

        return response()->json(['data' => $user]);
    }

    public function postQuery() {
        //
    }
}

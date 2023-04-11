<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll() {
        //
    }

    public function get(int $id) {
        $user = User::FindOrFail($id);
        $user->load('languages');
        $user->load('allergies');

        return response()->json(['data' => $user]);
    }

    public function postQuery() {
        //
    }
}

<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function logout() {
        try {
            Session::flush();
            Auth::logout();
            return response()->json(['success' => 'User successfully logged out'], 200);
        } catch (\Illuminate\Database\QueryException $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }
}

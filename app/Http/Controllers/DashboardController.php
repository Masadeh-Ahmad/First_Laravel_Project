<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user) {
            if ($user->isAdmin())
                return app(AdminController::class)->index($user);

            return app(StudentController::class)->index($user);
        }
        else
            return view('auth.login');
    }
}

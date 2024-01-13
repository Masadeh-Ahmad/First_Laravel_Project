<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function index($user)
    {
        return view('dashboard.student',['user'=>$user]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    public function addSubject(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'pass_mark' => 'required|numeric|min:1'
        ]);
        $subject = new Subject($validatedData);
        $subject->save();
        return response()->json(['success' => true, 'message' => 'successful']);
    }
    public function addSubjectForm()
    {
        return view('addSubjectForm');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    public function index($user)
    {
        $students = User::where('admin', false)->get();
        $subjects = Subject::all();
        return view('dashboard.admin',['students' => $students, 'subjects'=>$subjects]);
    }

    public function deleteUser($id)
    {
        User::destroy($id);
        return redirect()->route('dashboard');
    }
    public function editUserForm($id)
    {
        $user = User::find($id);
        return view('editUserForm', compact('user'));
    }
    public function editUser($id,Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255','min:8'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($id),
        ]]);
        $user = User::find($id);
        if($user){
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->active = $request->get('activation') == 'false' ? 0:1;

            $user->save();
        }
        return redirect()->route('dashboard');

    }
    public function setMark(Request $request)
    {
        $pivot_id = $request->get('submit_button');
        $new_mark = $request->input("new_mark_$pivot_id");
        $request->validate([
            "new_mark_$pivot_id" => 'required|numeric|min:1'
        ]);
        DB::table('subject_user')->where('id', $pivot_id)->update(['mark_obtained' => $new_mark]);
        return redirect()->route('enrollments');
    }

    /**
     * @throws ValidationException
     */
    public function enroll(Request $request)
    {
        $user = User::find($request->get('user'));
        $subject = Subject::find($request->get('subject'));
        if(!$subject || !$user || $user->admin){
            return response()->json(['success' => false, 'message' => 'An unexpected error occurred. Please try again.']);
        }
        try {
            $user->subjects()->attach($subject->id);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => 'Unallowable Operation']);
        }
        return response()->json(['success' => true, 'message' => 'Enrollment successful']);
    }
    public function enrollments()
    {
        $students = User::where('admin',false)->get();
        return view('enrollments',compact('students'));
    }

    public function enrollForm()
    {
        $subjects = Subject::all();
        $users = User::where('admin',false)->get();
        return view('enrollForm', compact('subjects','users'));
    }


}

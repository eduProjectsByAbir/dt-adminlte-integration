<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('admin.student.student-index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create-student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:35',
            'email' => 'required|email|max:255|unique:students,email',
            'avatar' =>  'required|image|mimes:jpeg,png,jpg,gif',
            'password'  => 'required|min:6|max:32',
            'password_confirmation' => 'required|min:6|same:password'

        ]);

        if ($request->hasFile('avatar')){
            $avatar = $request->avatar->move('backend/admin/images/', $request->avatar->hashName());
        }


        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatar,
            'password' => $request->password
        ]);

        if($student){
            Toastr::success('WOW! New Student added successfully!', 'Created', ["positionClass" => "toast-top-center"]);
        }
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $studentData = $student;
        return view('admin.student.edit-student', compact('studentData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // Data Validation
        $request->validate([
            'name' => 'required|string|min:2|max:35',
            'email' => 'required|email|max:255|unique:students,email,'.$student->id,
        ]);

        // Validate password if want to change
        if ($request->change_password == 1) {
            $this->validate($request, [
                'password'  => 'required|min:6',
                'password_confirmation' => 'required|min:6|same:password'
            ]);
        }

        // Validate image if want to profile image
        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' =>  'image|mimes:jpeg,png,jpg,gif'
            ]);
        }

        if ($request->hasFile('avatar')) {
            $oldPicture = $student->avater;
            if (file_exists($oldPicture)) {
                if ($oldPicture != 'backend/images/default.png') {
                    unlink($oldPicture);
                }
            }
            $avatar = $request->avatar->move('backend/admin/images/', $request->avatar->hashName());
        }
        if ($request->hasFile('avatar') && $request->filled('password')){
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $avatar,
                'password' => $request->password
            ]);
        } elseif($request->hasFile('avatar')){
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => $avatar
            ]);
        } elseif ($request->filled('password')) {
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
        } else {
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        Toastr::success('WOW! Your student info updated!', 'Update Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        // going to delete student data
        if(file_exists('backend/admin/images/'.$student->image) AND !empty($student->image)){
            unlink('backend/admin/images/'.$student->image);
        }
        $student->delete();
        Toastr::warning('Student deleted successfully!', 'Deleted!', ["positionClass" => "toast-top-center"]);
        return redirect()->route('students.index');

    }
}

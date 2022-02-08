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

        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar->move('backend/uploads/', $request->avatar->hashName());
        }


        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatar,
            'password' => $request->password
        ]);

        if ($student) {
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
        if ($request) {
            // validation
            $request->validate([
                'name' => 'required|string|min:2|max:35',
                'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            ]);

            // updating data
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        // Validate password if want to change
        if ($request->change_password == 1 && $request->filled('password')) {
            $request->validate([
                'password'  => 'required|min:6|max:35',
                'password_confirmation' => 'required|min:6|same:password',
            ]);

            // Updating password
            $student->update([
                'password' => $request->password
            ]);
        }

        // Validate image if want to profile image
        if ($request->hasFile('avatar')) {
            $request->validate([
                'avatar' =>  'image|mimes:jpeg,png,jpg,gif'
            ]);

            $oldPicture = $student->avater;
            if (file_exists($oldPicture) && $oldPicture != 'backend/admin/images/default.png') {
                // unlink old image
                unlink($oldPicture);
            }
            // save file to host
            $avatar = $request->avatar->move('backend/uploads/', $request->avatar->hashName());

            //change avatar
            $student->update([
                'avatar' => $avatar
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
        if ($student->avatar && $student->avatar != 'backend/admin/images/default.png') {
            unlink($student->avatar);
        }
        $student->delete();

        Toastr::warning('Student deleted successfully!', 'Deleted!', ["positionClass" =>"toast-top-center"]);
        return redirect()->route('students.index');
    }
}

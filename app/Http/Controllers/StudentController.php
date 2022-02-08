<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreValidation;
use App\Http\Requests\StudentUpdateValidation;
use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('admin.student.student-index', compact('students'));
    }

    public function create()
    {
        return view('admin.student.create-student');
    }

    public function store(StudentStoreValidation $request)
    {

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
    public function update(StudentUpdateValidation $request, Student $student)
    {
        if ($request) {
            // updating data
            $student->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        // Validate password if want to change
        if ($request->change_password === 1) {
            // Updating password
            $student->update([
                'password' => $request->password
            ]);
        }

        // Validate image if want to profile image
        if ($request->hasFile('avatar')) {

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

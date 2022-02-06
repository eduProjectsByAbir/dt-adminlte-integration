<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

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

        $student_data = new Student();
        $student_data->name = $request->name;
        $student_data->email = $request->email;
        $avatar = time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('backend/admin/images/'), $avatar);
        $avatar = 'backend/admin/images/' . $avatar;
        $student_data->avatar = $avatar;
        $student_data->password = bcrypt($request->password);
        $student_data->save();
        Toastr::success('WOW! New Student added successfully!', 'Created', ["positionClass" => "toast-top-center"]);
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
    public function edit($id)
    {
        $studentData = Student::find($id);
        return view('admin.student.edit-student', compact('studentData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Data Validation
        $request->validate([
            'name' => 'required|string|min:2|max:35',
            'email' => 'required|email|max:255|unique:students,email,'.$id,
        ]);

        // Validate password if want to change
        if ($request->change_password == 1) {
            $this->validate($request, [
                'password'  => 'required|min:6',
                'password_confirmation' => 'required|min:6|same:password'
            ]);
        }

        // Validate image if want to profile image
        if ($request->avatar) {
            $request->validate([
                'avatar' =>  'image|mimes:jpeg,png,jpg,gif'
            ]);
        }

        $student = Student::FindOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        if ($request->avater) {
            $oldPicture = $student->avater;
            if (file_exists($oldPicture)) {
                if ($oldPicture != 'backend/images/default.png') {
                    unlink($oldPicture);
                }
            }
            $imageName = time() . '.' . $request->avater->extension();
            $request->avater->move(public_path('backend/admin/images/'), $imageName);
            $newPicture = 'backend/admin/images/' . $imageName;
            $student->avater = $newPicture;
        }
        if ($request->password) {
            $student->password = bcrypt($request->password);
        }
        $student->save();

        Toastr::success('WOW! Your student info updated!', 'Update Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // going to delete student data
        $data = Student::find($id);
        if(file_exists('backend/admin/images/'.$data->image) AND !empty($data->image)){
            unlink('backend/admin/images/'.$data->image);
        }
        $data->delete();
        Toastr::warning('Student deleted successfully!', 'Created', ["positionClass" => "toast-top-center"]);
        return redirect()->route('students.index');

    }
}

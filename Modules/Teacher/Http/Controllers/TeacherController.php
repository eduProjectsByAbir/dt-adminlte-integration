<?php

namespace Modules\Teacher\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Teacher\Entities\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher::index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('teacher::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:36|string',
            'email' => 'required|unique:teachers,email|email',
            'number' => 'required|numeric|min:10'
        ]);

        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number
        ]);

        if($teacher){
            Toastr::success('WOW! New Student added successfully!', 'Created', ["positionClass" => "toast-top-center"]);
            return redirect()->route('teachers.index');
        } else {
            Toastr::warning('Something is Wrong!', 'Error');
            return redirect()->back();
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('teacher::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('teacher::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Teacher $teacher, Request $request)
    {
        dd($teacher);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

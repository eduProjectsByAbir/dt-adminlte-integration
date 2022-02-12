<?php

namespace Modules\Teacher\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Teacher\Entities\Teacher;
use Modules\Teacher\Http\Requests\TeacherStoreRequest;
use Modules\Teacher\Http\Requests\TeacherUpdateRequest;

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
    public function store(TeacherStoreRequest $request)
    {
        $teacher = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number
        ]);

        if($teacher){
            Toastr::success('WOW! Teacher added successfully!', 'Created');
            return redirect()->route('teachers.index');
        } else {
            Toastr::warning('Something is Wrong!', 'Error');
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher::edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TeacherUpdateRequest $request, $id)
    {

        $teacher = Teacher::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number
        ]);

        if($teacher){
            Toastr::success('WOW! Teacher updated successfully!', 'Created', ["positionClass" => "toast-top-center"]);
            return redirect()->route('teachers.index');
        } else {
            Toastr::warning('Something is Wrong!', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id)->delete();
        if($teacher){
            Toastr::success('WOW! Teacher Deleted!', 'Created', ["positionClass" => "toast-top-center"]);
            return redirect()->route('teachers.index');
        } else {
            Toastr::warning('Something is Wrong!', 'Error');
            return redirect()->back();
        }
    }
}

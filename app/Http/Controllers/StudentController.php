<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Studen;
use App\Http\Controllers\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Studen::latest()->paginate(5);
        return view('student', compact('students'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            "txtName" => "required",
            "txtAdd" => "required",
            "txtSchool" => "required",
            "txtFile" => "required|image|mimes:jpeg,png,jpg,svg,gif|max:2048",
        ]);

        $student = new Studen();
        $student->name = $request->txtName;
        $student->address = $request->txtAdd;
        $student->school = $request->txtSchool;
        $file = $request->txtFile;
        $url_file = "storage/" . $file->getClientOriginalName();
        $path = $file->storeAs('public/', $file->getClientOriginalName());
        $student->url_file = $url_file;
        $student->save();
        return redirect()->route('students.index')->with('success', 2);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Studen::find($id);
        return view('show_student', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Studen::find($id);
        return view('edit_student', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'txtName' => 'required',
            'txtAdd' => 'required',
            'txtSchool' => 'required',
            'txtFile' => 'required|image|mimes:jpeg, jpg, png, gif, svg|max:2048',
        ]);

        $student =  Studen::find($id);
        $student->name = $request->txtName;
        $student->address = $request->txtAdd;
        $student->school = $request->txtSchool;
        $file = $request->txtFile;
        $url_file = "storage/" . $file->getClientOriginalName();
        $path = $file->storeAs('/public', $file->getClientOriginalName());
        $student->url_file = $url_file;
        $student->save();
        return redirect()->route('students.index')->with('success', 15);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = new Studen();
        $student::find($id)->delete();
        return redirect()->route('students.index')->with('success', 25);
    }
}

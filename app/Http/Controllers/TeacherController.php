<?php

namespace App\Http\Controllers;
use App\Models\student;
use App\Models\Teacher;
use Illuminate\Http\Request;
class TeacherController extends Controller
{
    public function index()
    {
        return view('teacherform');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            'subject'=>'required',
            'phone'=>'required|min:10|max:10',
            'email'=>'required|email|max:255'
        ]);
        Teacher::create([
        'name'=> $validate["name"],
        'subject' => $validate["subject"],
        'phone'=> $validate["phone"],
        'email'=> $validate["email"]
        ]);
        return redirect()->route('teacher.create')->with('status','record inserted successfully');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher=teacher::all();
        return view('showtable',['teacher'=>$teacher]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('t_edit',['teacher'=>$teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validate=$request->validate([
            'name'=>'required|max:255|regex:/^[A-Za-z\s]+$/',
            'subject'=>'required',
            'phone'=>'required|min:10|max:10',
            'email'=>'required|email|max:255'
        ]);
        $teacher->name = $validate["name"];
        $teacher->subject = $validate["subject"];
        $teacher->phone = $validate["phone"];
        $teacher->email = $validate["email"];
        $teacher->update();
        return redirect()->route('teacher.create')->with ('status','record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $id=$teacher["id"];
        $teacher= teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->route('teacher.create')->with('status','record deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Department;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        $classrooms = Classroom::all();
        return view('Teachers.teacher', compact('departments', 'classrooms', 'teachers', 'subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try{

            DB::beginTransaction();
        //$teacher=Teacher::create($request->except('classrooms'));
        $teacher = new Teacher();
        $teacher->first_name = $request->first_name;
        $teacher->last_name = $request->last_name;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->subject_id = $request->subject_id;
        $teacher->department_id = $request->department_id;
        $teacher->password = Hash::make($request->phone);
        $teacher->save();

        $teacher->classrooms()->attach($request->input('classrooms'));
        toastr('teacher created successfully', 'success');
        DB::commit();
        return redirect()->route('dashboard.teachers.index');
        }
        catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->except('classrooms'));
        $teacher->classrooms()->sync($request->classrooms);
        toastr('Teacher created successfully','warning');
        return redirect()->route('dashboard.teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        $teacher->classrooms()->detach();
        toastr('Teacher deleted successfully', 'success');
        return redirect()->route('dashboard.teachers.index');
    }
}

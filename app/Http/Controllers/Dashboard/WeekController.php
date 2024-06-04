<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Table;
use App\Models\WeekTable;
use Exception;
use Illuminate\Http\Request;

class WeekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms=Classroom::all();
        return view('WeekTables.classrooms',compact('classrooms'));
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
        try {

            foreach ($request->list_classes as $list_class) {
            
               $list= WeekTable::create($list_class);
              
            }
            toastr()->success('created successfully');
            return redirect()->route('dashboard.week_tables.index');
        } catch (Exception $e) {
          //  return redirect()->back()->withErrors("Warning", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classroom=Classroom::find($id)->first();
       $tables=WeekTable::where('classroom_id',$id)->get();
       $subjects=$classroom->subjects;
       return view('WeekTables.index',compact('tables','classroom','subjects'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
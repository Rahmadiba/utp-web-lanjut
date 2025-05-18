<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Batch;
use Illuminate\View\View;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrolments = Enrollment::all();
        return view ('enrollments.index')->with('enrollments', $enrolments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::pluck('name', 'id');
        $students = Student::pluck('name', 'id');
        return view('admin.enrollments.create', compact('batches', 'students'));;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Enrollment::create($input);
        return redirect('enrollments')->with('flash_message', 'enrollment Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrolments = Enrollment::find($id);
        return view('enrollments.show')->with('enrollments', $enrolments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enrolments = Enrollment::find($id);
        return view('enrollments.edit')->with('enrollments', $enrolments);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enrolments = Enrollment::find($id);
        $input = $request->all();
        $enrolments->update($input);
        return redirect('enrollments')->with('flash_message', 'enrollment Updated!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Enrollment::destroy($id);
        return redirect('enrollments')->with('flash_message', 'enrollment deleted!'); 
    }
}
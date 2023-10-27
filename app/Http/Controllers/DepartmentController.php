<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{

    //to show department form
    function index(){
        $department=Department::all();
        return view('department',['department'=>$department]);
    }



    //to remove department
    function remove(Request $request){
        $department = Department::find(1);

        if ($department) {
            $department->delete();

            return redirect('/department')->with('deleted', 'Department Deleted!');
        } else {
            abort(404);
        }
    }


    //To Process Department to add
    function addDepartment(Request $request){

        $validatedData = $request->validate([
            'department' => 'required|unique:departments|string|max:255',
        ]);

        $user = Department::create([
            'department' => $validatedData['department'],
        ]);

        return redirect('/department')->with('success', 'Department added!');
    }
}

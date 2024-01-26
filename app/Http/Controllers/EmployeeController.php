<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class EmployeeController extends Controller
{  
    public function index()//:View
    {
        $employees = Employee::all();
        return response()->json($employees); 
    }   
    public function store(Request $request)//:RedirectResponse
    {
        $employees = new Employee([
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'mobile' => $request->input('mobile'),
        ]);
        $employees->save();
        return response()->json('Employee created!');
    }
    public function show($id)//:View
    {
        $employess = Employee::find($id);
        return response()->json($employess);
    }
    public function update(Request $request, $id)//:RedirectResponse
    {
       $employees = Employee::find($id);
       $employees->update($request->all());
       return response()->json('Employee updated');
    }
    public function destroy($id)//:RedirectResponse
    {
        $employees = Employee::find($id);
        $employees->delete();
        return response()->json(' deleted!');
    }
}

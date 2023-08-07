<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
	public function index()
	{

		$employees = Employee::all();

		$response = [
			'code' => 200,
			'message' => 'Ok',
			'data' => $employees
		];

		return response()->json($response);
	}

	public function show($employeeId)
	{

		$employee = Employee::where('id',$employeeId)->with('skills')->first();

		if($employee !== null)
		{
			$response = [
				'code' => 200,
				'message' => 'Ok',
				'data' => $employee
			];
		}else
		{
			$response = [
				'code' => 404,
				'message' => 'Not found',
				'data' => null
			];
		}

		

		return response()->json($response);
	}

	public function create(Request $request)
	{
		/*Validation*/

		$employee = Employee::create($request->only([
			'name',
			'email',
			'position',
			'address',
			'birthday'
		]));

		foreach ($request->input('skills') as $key => $skill) {
			$employee->skills()->attach($skill, [ 'expertise' => $request->input('expertises')[$key] ]);
		}

		$response = [
			'code' => 200,
			'message' => 'Ok',
			'data' => $employee
		];
		

		return response()->json($employee);
	}


}

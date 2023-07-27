<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); // Assuming you are using Laravel's authentication

        $employees = Employee::orderBy('id', 'desc')->get();

        if ($user->role === 'tech') {
            $employees = $employees->where('user_id', $user->id);
        }

        return view("employees.index", ['employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $user = Auth::user(); // Assuming you are using Laravel's authentication

        if ($user->role === 'tech' && $employee->user_id !== $user->id) {
            return abort(403, 'Unauthorized');
        }

        $employee = Employee::with('user')->where('id', $employee->id)->first();
        return view("employees.edit", compact("employee"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $user = Auth::user(); // Assuming you are using Laravel's authentication

        if ($user->role === 'tech' && $employee->user_id !== $user->id) {
            return abort(403, 'Unauthorized');
        }

        $this->requestValidation($request);

        if ($request->role == "tech") {
            if (strlen($request->password) != null) {
                User::where('id', $request->user_id)->update([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' => Hash::make($request->password),
                ]);
            } else {
                User::where('id', $request->user_id)->update([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'role' => $request->role,
                    'password' => Hash::make($request->password),
                ]);
            }

            $employee->update($request->except(['email', 'password', 'user_id']));
        } else {
            $employee->update($request->except(['email', 'password', 'user_id']));
        }

        return redirect("employees/".$employee->id."/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        User::where('id', $employee->user_id)->delete();
        $employee->delete();
        return redirect("employees")->with("success", "Employee record is removed");
    }

    public function requestValidation(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'salary' => 'required',
            'doj' => 'required',
            'dob' => 'required',
            'status' => 'required',
            'role' => 'required',
        ]);
    }
}


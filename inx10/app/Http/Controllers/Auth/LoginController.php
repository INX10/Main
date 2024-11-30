<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Use the Auth facade
use App\Models\UserLogin;
use App\Http\Controllers\LeaveController; // Import the LeaveController
use App\Models\EmployeeHistory; // Add the EmployeeHistory model


/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class LoginController extends Controller
{

    protected $auth;

    // Use dependency injection to get the Guard (Auth)

    protected function redirectTo()
{
    return session()->pull('url.intended', '/admin'); // Default to '/admin' if no intended URL exists
}

    public function __construct()
    {
        $this->auth = Auth::guard(); // Default guard
    }

    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function login(Request $request)
{
    $credentials = $request->only('user_ID', 'password');

    // Find the user by user_ID in the user_login table
    $user = UserLogin::where('user_ID', $credentials['user_ID'])->with('employeeInfo')->first();

    // Check if the user exists and the password matches
    if ($user && $user->user_password === $credentials['password']) {
        // Retrieve employee ID from the employee_information table
        $employee = $user->employeeInfo;

        if ($employee) {
            // Retrieve the employee's status from the employee_history table
            $employeeHistory = EmployeeHistory::where('employee_ID', $employee->employee_ID)->first();

            if ($employeeHistory && $employeeHistory->status == 1) {
                // If status is 1 (active), log in the user
                auth()->login($user);

                // Store the user type in session
                session(['user_type' => $user->user_type]);

                // Redirect to their designated page
                switch ($user->user_type) {
                    case 1:
                        return redirect()->route('admin');
                    case 2:
                        return redirect()->route('employee');
                    case 3:
                        return redirect()->route('department');
                    default:
                        return redirect()->route('login')->withErrors('Invalid user type.');
                }
            } else {
                // If status is 0 (inactive), deny access
                return redirect()->back()->withErrors([
                    'user_ID' => 'Your account is inactive. Please contact the administrator.',
                ])->withInput($request->except('password'));
            }
        }
    }

    // If login fails, redirect back with an error message
    return redirect()->back()->withErrors([
        'user_ID' => 'The user ID or password is incorrect.',
    ])->withInput($request->except('password')); // Keep the user_ID field filled
}




   
}

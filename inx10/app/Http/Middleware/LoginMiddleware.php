<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserLogin;
use App\Models\EmployeeHistory;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function handle(Request $request, Closure $next)
{
    // If the user is authenticated, check their role and redirect accordingly
    if (Auth::check()) {
        $user = Auth::user();
        $employee = $user->employeeInfo;

        if ($employee) {
            // Retrieve employee status
            $employeeHistory = EmployeeHistory::where('employee_ID', $employee->employee_ID)->first();

            // Check if account is active
            if ($employeeHistory && $employeeHistory->status == 1) {
                // Store the user type in session if not already set
                if (!session()->has('user_type')) {
                    session(['user_type' => $user->user_type]);
                }

                // Redirect based on user type if not already on the correct page
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
                return redirect()->route('login')->withErrors('Your account is inactive.');
            }
        }
    }

    // Continue if not authenticated
    return $next($request);
}
}

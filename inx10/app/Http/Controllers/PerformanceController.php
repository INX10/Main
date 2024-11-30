<?php


namespace App\Http\Controllers;


use Carbon\Carbon; // To handle dates
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\EmployeeHistory;
use App\Models\EmployeeEvaluation;
use App\Models\EvaluationScale;
use App\Models\UserLogin;
use App\Models\EmployeeInformation;
use App\Models\EmployeeDepartment;
use App\Models\RecommendAction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



use Illuminate\Http\Request;

class PerformanceController extends Controller
{
     /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

    public function showAdmin()
        {
            $departments = EmployeeDepartment::all();
            $recommendedActions = DB::table('recommend_action')->get(); // Fetch recommend_action values
        
            return view('admin', compact('departments', 'recommendedActions'));
        }

    public function showAllDepartmentPage()
        {
            $departments = DB::table('employee_department')->select('department_ID', 'department_name')->get();
            return response()->json($departments);
        }
        
        

         /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.CamelCaseVariableName)
 */
    public function getEmployeesByDepartmentForPerformanceEval($departmentId)
        {
            $employees = EmployeeInformation::select(
                'employee_information.employee_ID',
                'employee_information.first_name',
                'employee_information.middle_name',
                'employee_information.last_name',
                'employee_information.suffix',
                'employee_history.start_date' // Fetch the start_date
            )
            ->join('employee_history', 'employee_information.employee_ID', '=', 'employee_history.employee_ID')
            ->where('employee_history.department_ID', $departmentId)
            ->get();

            return response()->json($employees);
        }
         /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */

    public function showForm()
        {
            $user = Auth::user(); // Get the authenticated user
            $recommendActions = DB::table('recommend_action')->get(); // Fetch the recommend actions from the database
        
            return view('admin', compact('user', 'recommendActions')); // Pass the user and recommend actions to the view// Pass the user to the view
        }

        public function showActionDepartment()
        {
            // Retrieve recommended actions from the recommend_action table
            $recommendedActions = DB::table('recommend_action')->get();
            
            // Return a JSON response (suitable for AJAX) with the recommended actions
            return response()->json($recommendedActions);
        }

        public function storeAdminEvaluation(Request $request)
{
    return $this->storeEvaluationData($request, 'admin');
}

public function storeDepartmentEvaluation(Request $request)
{
    return $this->storeEvaluationData($request, 'department');
}
        

    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.DuplicatedArrayKey)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
private function storeEvaluationData(Request $request, $role)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'evaluation_type' => 'required|string|max:45',
        'employee_ID' => 'required|integer',
        'evaluation_start' => 'required|date',
        'evaluation_end' => 'required|date',
        'results' => 'required|numeric|min:1|max:5',
        'comment_rater' => 'nullable|string|max:150',
        'comment_ratee' => 'nullable|string|max:150',
        'action' => 'required|integer',
    ]);

    // Create a new EmployeeEvaluation instance and assign values
    $evaluation = new EmployeeEvaluation();
    $evaluation->evaluation_type = $validatedData['evaluation_type'];
    $evaluation->employee_ID = $validatedData['employee_ID'];
    $evaluation->employee_dept = $request->input('department');
    $evaluation->date_evaluated = now();
    $evaluation->evaluation_start = $validatedData['evaluation_start'];
    $evaluation->evaluation_end = $validatedData['evaluation_end'];
    $evaluation->performance_rating = $validatedData['results'];
    $evaluation->remark_offense = $request->input('comment-1');
    $evaluation->remark_accomplish = $request->input('comment-2');
    $evaluation->remark_forimprove = $request->input('comment-3');
    $evaluation->comment_rater = $request->input('comment-4');
    $evaluation->comment_ratee = $request->input('comment-5');
    $evaluation->recommended_action = $validatedData['action'];

    // Retrieve the authenticated user's ID and set as rater_ID
    $userId = Auth::id();
    $user = UserLogin::find($userId);
    if ($user && $user->employeeInfo) {
        $evaluation->rater_ID = $user->employeeInfo->employee_ID;
    } else {
        return redirect()->back()->withErrors(['error' => 'Unable to retrieve employee information.']);
    }
    
    // Save the evaluation and the evaluation scale
    $evaluation->save();
    $evaluationID = $evaluation->evaluation_ID;

    $evaluationScale = new EvaluationScale();
    $evaluationScale->evaluation_ID = $evaluationID;
    $evaluationScale->sectionA_1 = $request->input('eval-1') ?: 0.00;
    $evaluationScale->sectionA_2 = $request->input('eval-2') ?: 0.00;
    $evaluationScale->sectionA_3 = $request->input('eval-3') ?: 0.00;
    $evaluationScale->sectionA_4 = $request->input('eval-4') ?: 0.00;
    $evaluationScale->sectionB_1 = $request->input('eval-5') ?: 0.00;
    $evaluationScale->sectionB_2 = $request->input('eval-6') ?: 0.00;
    $evaluationScale->sectionC_1 = $request->input('eval-7') ?: 0.00;
    $evaluationScale->sectionC_2 = $request->input('eval-8') ?: 0.00;
    $evaluationScale->sectionC_3 = $request->input('eval-9') ?: 0.00;
    $evaluationScale->save();

    // Redirect back with a success message based on role
    $route = $role === 'admin' ? 'admin' : 'department';
    return redirect()->route($route)->with('success', 'Evaluation saved successfully!');
}

     /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.DuplicatedArrayKey)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function getAllEvaluations()
{
    $evaluations = DB::table('employee_evaluation as ee')
        ->join('employee_information as ei', 'ee.employee_ID', '=', 'ei.employee_ID')
        ->join('employee_information as er', 'ee.rater_ID', '=', 'er.employee_ID')
        ->join('recommend_action as ra', 'ee.recommended_action', '=', 'ra.recommended_action')
        ->select(
              'ei.first_name as employee_first_name',
            'ei.last_name as employee_last_name',
            'er.first_name as rater_first_name',
            'er.last_name as rater_last_name',
            'ee.date_evaluated',
            'ra.value as recommended_action',
            'ee.performance_rating',
            'ee.evaluation_start',
            'ee.evaluation_end',
            'ee.remark_offense',
            'ee.remark_accomplish',
            'ee.remark_forimprove',
            'ee.comment_rater',
            'ee.comment_ratee'
        )
        ->orderByDesc('ee.date_evaluated') 
        ->get();

    return response()->json($evaluations);
}

public function getLatestEvaluations()
{
    // Fetch the latest 3 evaluations, ordered by date (descending)
    $evaluations = DB::table('employee_evaluation as ee')
        ->join('employee_information as ei', 'ee.employee_ID', '=', 'ei.employee_ID')
        ->join('employee_information as er', 'ee.rater_ID', '=', 'er.employee_ID')
        ->join('recommend_action as ra', 'ee.recommended_action', '=', 'ra.recommended_action')
        ->select(
            'ei.first_name as employee_first_name',
            'ei.last_name as employee_last_name',
            'er.first_name as rater_first_name',
            'er.last_name as rater_last_name',
            'ee.date_evaluated',
            'ra.value as recommended_action',
            'ee.performance_rating',
            'ee.evaluation_start',
            'ee.evaluation_end',
            'ee.remark_offense',
            'ee.remark_accomplish',
            'ee.remark_forimprove',
            'ee.comment_rater',
            'ee.comment_ratee'
        )
        ->orderByDesc('ee.date_evaluated')
        ->limit(3) // Limit to only the latest 3 evaluations
        ->get();

    return response()->json($evaluations);
}

  /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.DuplicatedArrayKey)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
 
 public function getEmployeePerformanceEval(Request $request)
{
    // Assuming the user is authenticated
    $userId = auth()->user()->user_ID; // Get the logged-in user's ID

    // Get the employee ID associated with the user
    $employee = DB::table('employee_information')
        ->where('user_ID', $userId)
        ->first();

    if (!$employee) {
        return response()->json(['error' => 'Employee not found'], 404);
    }

    // Get performance evaluation data for the employee
    $evaluation = DB::table('employee_evaluation')
        ->where('employee_ID', $employee->employee_ID)
        ->first();

    if (!$evaluation) {
        return response()->json(['error' => 'Evaluation not found'], 404);
    }

    // Get the rater's name
    $rater = DB::table('employee_information')
        ->where('employee_ID', $evaluation->rater_ID)
        ->first();

    // Get the recommended action value
    $recommendedAction = DB::table('recommend_action')
        ->where('recommended_action', $evaluation->recommended_action)
        ->first();

        return response()->json([
            'evaluated_by' => $rater ? "{$rater->first_name} {$rater->last_name}" : 'N/A',
            'evaluation_type' => $evaluation->evaluation_type,
            'evaluation_start' => $evaluation->evaluation_start,
            'evaluation_end' => $evaluation->evaluation_end,
            'remark_offense' => $evaluation->remark_offense,
            'remark_accomplish' => $evaluation->remark_accomplish,
            'remark_forimprove' => $evaluation->remark_forimprove,
            'comment_rater' => $evaluation->comment_rater,
            'comment_ratee' => $evaluation->comment_ratee,
            'recommended_action' => $recommendedAction ? $recommendedAction->value : 'N/A',
            'performance_rating' => $evaluation->performance_rating, // Add performance rating here
        ]);
        
        
}

 /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.DuplicatedArrayKey)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public function getAllPerformanceEvalEmployee()
{
    $userId = Auth::id();
    $employee = EmployeeInformation::where('user_ID', $userId)->first();
    
    if (!$employee) {
        return response()->json([]);
    }

    $evaluations = EmployeeEvaluation::with(['rater', 'recommendAction'])
        ->where('employee_ID', $employee->employee_ID)
        ->get();

    $evaluationData = $evaluations->map(function($evaluation) {
        return [
            'rater_name' => $evaluation->rater->first_name . ' ' . $evaluation->rater->last_name,
            'rating' => $evaluation->performance_rating,
            'date' => Carbon::parse($evaluation->date_evaluated)->format('Y-m-d'),
            'recommended_action' => $evaluation->recommendAction->value, // This should work now!
            'remark_offense' => $evaluation->remark_offense,
            'remark_accomplish' => $evaluation->remark_accomplish,
            'remark_forimprove' => $evaluation->remark_forimprove,
            'comment_rater' => $evaluation->comment_rater,
            'comment_ratee' => $evaluation->comment_ratee,
            'evaluation_type' => $evaluation->evaluation_type,
            'evaluation_start' => $evaluation->evaluation_start,
            'evaluation_end' => $evaluation->evaluation_end
            
        ];
    });

    Log::info('Evaluation Data:', $evaluationData->toArray());

    return response()->json($evaluationData);
}

 /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.DuplicatedArrayKey)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */

public function getAllEvaluationFormDepartment()
{
    $evaluations = DB::table('employee_evaluation')
        ->join('employee_information', 'employee_evaluation.employee_ID', '=', 'employee_information.employee_ID')
        ->join('employee_history', 'employee_evaluation.employee_ID', '=', 'employee_history.employee_ID')
        ->join('employee_department', 'employee_history.department_ID', '=', 'employee_department.department_ID')
        ->join('recommend_action', 'employee_evaluation.recommended_action', '=', 'recommend_action.recommended_action')
        ->select(
            'employee_information.first_name',
            'employee_information.last_name',
            'employee_department.department_name',
            'employee_evaluation.date_evaluated',
            'employee_evaluation.performance_rating',
            'recommend_action.value as recommended_action'
        )
        ->orderBy('employee_evaluation.evaluation_ID', 'desc') // Order by latest evaluations
        ->get();

    return response()->json($evaluations);
}

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.DuplicatedArrayKey)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */

}
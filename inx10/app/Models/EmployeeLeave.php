<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    use HasFactory;

    protected $table = 'employee_leave';    

    protected $primaryKey='leave_ID';
    
    protected $fillable = [
        'employee_ID',
        'date_applied',
        'leave_from',
        'leave_to',
        'hours_no',
        'leave_type',
        'leave_type_other',
        'reason',
        'manager_approval',
        'manager_ID',
        'manager_date_approved',
        'hr_approval',
        'hr_ID',
        'hr_date_approved'
    ];

    public $timestamps = false;
    
    public function employeeHistory()
{
    return $this->belongsTo(EmployeeHistory::class, 'employee_ID', 'employee_ID');
}
public function leaveType()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type', 'leave_type');
    }


}

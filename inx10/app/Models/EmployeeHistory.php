<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeHistory extends Model
{
    use HasFactory;


    protected $table = 'employee_history'; // Link to your employee_history table

    protected $fillable = [
        'employee_ID',
        'department_ID',
        'job_ID',
        'start_date',
        'status'

    ];

    public function employee() {
        return $this->belongsTo(EmployeeInformation::class, 'employee_ID','employee_ID'); // Adjust 'employee_ID' to your actual foreign key
    }

    
    
}

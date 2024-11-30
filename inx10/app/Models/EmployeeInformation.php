<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeInformation extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'employee_information';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'employee_ID';

    // If the primary key is not an incrementing integer, specify its type
    public $incrementing = true;

    // Allow mass assignment for these fields
    protected $fillable = [
       'user_ID', 'first_name', 'middle_name', 'last_name'
    ];

    // Automatically handle created_at and updated_at timestamps
    public $timestamps = true;

    public function otherInfo()
    {
        return $this->hasOne(EmployeeOtherInfo::class, 'employee_ID', 'employee_ID');
    }

    public function employeeHistory() {
        return $this->hasMany(EmployeeHistory::class, 'employee_ID','employee_ID');
    }
    public function employeeEval() {
        return $this->hasMany(EmployeeEvaluation::class, 'employee_ID','employee_ID');
    }
    public function employeeEvaluation() {
        return $this->hasMany(EmployeeEvaluation::class, 'rater_ID','employee_ID');
    }

    public function userLogin() {
        return $this->hasMany(UserLogin::class, 'employee_ID','employee_ID');
    }
    public function userLoginUser() {
        return $this->hasMany(UserLogin::class, 'user_ID','user_ID');
    }

    public function document()
    {
        return $this->hasOne(EmployeeDocument::class, 'employee_ID', 'employee_ID');
    }

    public function contactInfo()
    {
        return $this->hasOne(EmployeeContactInfo::class, 'employee_ID', 'employee_ID');
    }

}
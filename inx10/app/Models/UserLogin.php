<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserLogin extends Authenticatable
{
    protected $table = 'user_login'; // Specify the table name

    protected $primaryKey = 'user_ID'; // Set the primary key

    public $incrementing = false; // Since user_ID is not auto-incrementing

    protected $keyType = 'string'; // Set the key type to string

    protected $fillable = ['user_ID', 'user_password', 'user_type']; // Specify mass assignable attributes

    public $timestamps = false; // Disable timestamps if not needed

    // Add any additional methods or properties needed for your application

    // Correct the relationship in UserLogin model
public function employeeInfo() {
    return $this->hasOne(EmployeeInformation::class, 'user_ID', 'user_ID');
}


        public function employeeInformation() {
            return $this->hasMany(EmployeeInformation::class, 'employee_ID','employee_ID');
        }
        public function employeeHistory()
        {
            return $this->hasOne(EmployeeHistory::class, 'employee_ID', 'user_ID');
        }

}

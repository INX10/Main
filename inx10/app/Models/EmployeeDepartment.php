<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    // If your table name is not the plural form of the model name, specify it
    protected $table = 'employee_department';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'department_ID';

    // Disable timestamps if not used in your table
    public $timestamps = true;

    // If you want to specify which attributes can be mass assigned
    protected $fillable = ['department_name', 'department_description'];

    
}

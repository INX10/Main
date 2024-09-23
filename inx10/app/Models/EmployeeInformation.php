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
    protected $keyType = 'bigint';

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_ID', 'first_name', 'middle_name', 'last_name'
    ];

    // Automatically handle created_at and updated_at timestamps
    public $timestamps = true;
}
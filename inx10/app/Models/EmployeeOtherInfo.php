<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeOtherInfo extends Model
{
    use HasFactory;

    protected $table = 'employee_otherinfo'; // Define the correct table name
    protected $primaryKey = 'employee_ID'; // Set the primary key if it differs from 'id'

    // Define which fields are fillable or guarded
    protected $fillable = [
        'employee_ID',
        'birth_date',
        // Add other fields here...
    ];
    public function employee()
    {
        return $this->belongsTo(EmployeeInformation::class, 'employee_ID', 'employee_ID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_ID',
        'email',
        'contact_no',
        'telephone_no',
        'permanent_address',
        'current_address'


    ];

    public function employee()
    {
        return $this->hasOne(EmployeeInformation::class, 'employee_ID', 'employee_ID');
    }
}

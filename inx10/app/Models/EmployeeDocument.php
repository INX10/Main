<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_ID',
        'filename',
        'document_file'

    ];

    public function employee()
    {
        return $this->hasOne(EmployeeInformation::class, 'employee_ID', 'employee_ID');
    }
}

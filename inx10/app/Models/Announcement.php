<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement';
       // Specify the primary key
    protected $primaryKey = 'announce_ID'; // Use your actual column name here
    protected $fillable = [
        'employee_ID', 
        'announce_subject', 
        'announce_body', 
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(EmployeeInformation::class, 'employee_ID'); // Assuming 'employee_ID' is the foreign key
    }
}

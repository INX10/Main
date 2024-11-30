<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationScale extends Model
{
    use HasFactory;
    protected $table = 'evaluation_scale';

    public $timestamps = false;
    protected $fillable = [
        'evaluation_ID',
        'sectionA_1',
        'sectionA_2',
        'sectionA_3',
        'sectionA_4',
        'sectionB_1',
        'sectionB_2',
        'sectionC_1',
        'sectionC_2',
        'sectionC_3',
    ];

    // Define the relationship with EmployeeEvaluation
    public function employeeEvaluation()
    {
        return $this->belongsTo(EmployeeEvaluation::class, 'evaluation_ID', 'evaluation_ID');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeEvaluation extends Model
{
    use HasFactory;

    protected $table = 'employee_evaluation'; // Define the correct table name
    protected $primaryKey = 'evaluation_ID'; 
    public $timestamps = false;
    protected $fillable = [
        'evaluation_type',
        'employee_ID',
        'employee_dept',
        'rater_ID',
        'date_evaluated',
        'evaluation_start',
        'evaluation_end',
        'performance_rating',
        'remark_offense',
        'remark_accomplish',
        'remark_forimprove',
        'comment_rater',
        'comment_ratee',
        'recommended_action',
    ];

    
    public function recommendAction()
    {
        return $this->hasOne(RecommendAction::class, 'recommended_action', 'recommended_action');
    }
    public function rater()
{
    return $this->belongsTo(EmployeeInformation::class, 'rater_ID', 'employee_ID');
}
}

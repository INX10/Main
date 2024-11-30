<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendAction extends Model
{
    use HasFactory;

    protected $table = 'recommend_action'; 
    protected $primaryKey = 'recommended_action'; 

    protected $fillable = [
        'value'
    ];

    public function evaluation()
    {
        return $this->hasOne(EmployeeEvaluation::class, 'recommended_action', 'recommended_action');
    }
}

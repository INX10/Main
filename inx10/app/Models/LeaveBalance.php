<?php

// app/Models/LeaveBalance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    use HasFactory;

    protected $table = 'leave_balance';

    protected $fillable = [
        'employee_ID',
        'leave_type',
        'balance',
        'created_at',
        'updated_at',
    ];
}


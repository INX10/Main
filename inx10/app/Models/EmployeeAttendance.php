<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class EmployeeAttendance extends Model
    {
        use HasFactory;

        protected $table = 'employee_attendance';

        protected $fillable = [
            'employee_name',
            'date',
            'time_in',
            'time_out',
            'hours_required',
            'hours_worked',
            'hours_overtime',
            'hours_undertime',
            'if_resign',
        ];
    }


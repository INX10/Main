<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_login', function (Blueprint $table) {
            $table->string('user_ID', 20)->primary();
            $table->string('user_password', 50);
            $table->integer('user_type');
        });

        Schema::create('employee_information', function (Blueprint $table) {
            $table->bigIncrements('employee_ID'); // BIGINT auto-incrementing ID
            $table->string('user_ID', 20);
            $table->string('first_name', 45);
            $table->string('middle_name', 45);
            $table->string('last_name', 45);
            $table->timestamps();

            $table->unique('employee_ID', 'employee_ID_UNIQUE');
            $table->index('user_ID', 'user_ID(employee_information)_idx');
            $table->foreign('user_ID')->references('user_ID')->on('user_login');
        });

        Schema::create('employee_job', function (Blueprint $table) {
            $table->bigIncrements('job_ID'); // BIGINT auto-incrementing ID
            $table->string('job_title', 45);
            $table->timestamps();

            $table->unique('job_ID', 'job_ID_UNIQUE');
        });

        Schema::create('employee_department', function (Blueprint $table) {
            $table->bigIncrements('department_ID'); // BIGINT auto-incrementing ID
            $table->string('department_name', 45);
            $table->string('department_description', 100);
            $table->timestamps();

            $table->unique('department_ID', 'department_ID_UNIQUE');
        });

        Schema::create('employee_history', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->unsignedBigInteger('job_ID');
            $table->unsignedBigInteger('department_ID');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('status');
            $table->timestamps();

            // Indexes
            $table->index('employee_ID', 'employee_ID_idx');
            $table->index('job_ID', 'job_ID_idx');
            $table->index('department_ID', 'department_ID(employee_history)_idx');

            // Foreign keys
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
            $table->foreign('job_ID')->references('job_ID')->on('employee_job');
            $table->foreign('department_ID')->references('department_ID')->on('employee_department');
        });

        Schema::create('employee_contactinfo', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->string('email', 45);
            $table->string('contact_no', 15);
            $table->string('telephone_no', 15)->nullable();
            $table->string('permanent_address', 100);
            $table->string('current_address', 100);
            $table->timestamps();

            // Unique key
            $table->unique('employee_ID', 'employee_ID_UNIQUE');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('employee_otherinfo', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->date('birth_date');
            $table->string('birth_place', 100);
            $table->string('civil_status', 45);
            $table->timestamps();

            // Unique key
            $table->unique('employee_ID', 'employee_ID_UNIQUE');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('employee_education', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->string('highschool', 100);
            $table->string('college', 100);
            $table->string('remarks', 100)->nullable();
            $table->timestamps();

            // Unique key
            $table->unique('employee_ID', 'employee_ID_UNIQUE');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('employee_workhistory', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('company', 50);
            $table->string('remarks', 100)->nullable();
            $table->timestamps();

            // Index
            $table->index('employee_ID', 'employee_ID(employee_workhistory)_idx');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('employee_governmentid', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->string('sss', 10)->nullable();
            $table->string('philhealth', 12)->nullable();
            $table->string('pagibig', 12)->nullable();
            $table->string('tin', 12)->nullable();
            $table->timestamps();

            // Unique keys
            $table->unique('employee_ID', 'employee_ID_UNIQUE');
            $table->unique('sss', 'sss_UNIQUE');
            $table->unique('philhealth', 'philhealth_UNIQUE');
            $table->unique('pagibig', 'pagibig_UNIQUE');
            $table->unique('tin', 'tin_UNIQUE');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('employee_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->string('filename', 45);
            $table->string('document_file', 70)->charset('utf8mb3')->collation('utf8mb3_general_ci');
            $table->timestamps();

            // Index
            $table->index('employee_ID', 'employee_ID(employee_documents)_idx');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('announcement', function (Blueprint $table) {
            $table->increments('announce_ID');
            $table->unsignedBigInteger('employee_ID');
            $table->string('announce_subject', 100);
            $table->text('announce_body')->nullable();
            $table->dateTime('date');
            $table->timestamps();

            // Unique key
            $table->unique('announce_ID', 'announce_ID_UNIQUE');

            // Index
            $table->index('employee_ID', 'employee_ID(announcement)_idx');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('employee_attendance', function (Blueprint $table) {
            $table->bigIncrements('attendance_ID'); // BIGINT auto-incrementing ID
            $table->unsignedBigInteger('employee_ID');
            $table->date('date');
            $table->time('time_in');
            $table->time('time_out');
            $table->decimal('hours_required', 4, 2);
            $table->decimal('hours_worked', 4, 2);
            $table->decimal('hours_overtime', 4, 2)->nullable();
            $table->decimal('hours_undertime', 4, 2)->nullable();
            $table->date('if_resign')->nullable();
            $table->timestamps();

            // Unique key
            $table->unique('attendance_ID', 'attendance_ID_UNIQUE');

            // Index
            $table->index('employee_ID', 'employee_ID(employee_attendance)_idx');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });

        Schema::create('leave_type', function (Blueprint $table) {
            $table->integer('leave_type')->primary();
            $table->string('value', 45);
            $table->timestamps();

            // Unique keys
            $table->unique('value', 'value_UNIQUE');
        });

        Schema::create('leave_balance', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_ID');
            $table->integer('leave_type');
            $table->decimal('balance', 10, 2);
            $table->timestamps();

            // Unique key
            $table->unique(['employee_ID', 'leave_type'], 'employee_leave_type_UNIQUE');

            // Index
            $table->index('employee_ID', 'employee_ID(leave_balance)_idx');

            // Foreign keys
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
            $table->foreign('leave_type')->references('leave_type')->on('leave_type');
        });

        Schema::create('employee_leave', function (Blueprint $table) {
            $table->increments('leave_ID');
            $table->integer('employee_ID');
            $table->date('date_applied')->nullable();
            $table->date('leave_from')->nullable();
            $table->date('leave_to')->nullable();
            $table->decimal('hours_no', 7, 2)->nullable();
            $table->integer('leave_type')->nullable();
            $table->string('leave_type_other', 45)->nullable();
            $table->string('reason', 45)->nullable();
            $table->boolean('manager_approval')->nullable();
            $table->integer('manager_ID')->nullable();
            $table->date('manager_date_approved')->nullable();
            $table->boolean('hr_approval')->nullable();
            $table->integer('hr_ID')->nullable();
            $table->date('hr_date_approved')->nullable();
        });

        Schema::create('evaluation_scale', function (Blueprint $table) {
            $table->integer('scale_value')->primary();
            $table->string('description', 100);
            $table->timestamps();

            // Unique key
            $table->unique('scale_value', 'scale_value_UNIQUE');
        });

        Schema::create('recommend_action', function (Blueprint $table) {
            $table->integer('action_ID')->primary();
            $table->string('description', 100);
            $table->timestamps();

            // Unique key
            $table->unique('action_ID', 'action_ID_UNIQUE');
        });

        Schema::create('employee_evaluation', function (Blueprint $table) {
            $table->bigIncrements('evaluation_ID'); // BIGINT auto-incrementing ID
            $table->unsignedBigInteger('employee_ID');
            $table->integer('rating');
            $table->string('comments', 200)->nullable();
            $table->timestamps();

            // Unique key
            $table->unique('evaluation_ID', 'evaluation_ID_UNIQUE');

            // Index
            $table->index('employee_ID', 'employee_ID(employee_evaluation)_idx');

            // Foreign key constraint
            $table->foreign('employee_ID')->references('employee_ID')->on('employee_information');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alltables');
    }
};

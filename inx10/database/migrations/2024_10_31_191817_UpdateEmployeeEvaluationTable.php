<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateEmployeeEvaluationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function up()
    {
        // Create recommend_action table
        Schema::create('recommend_action', function (Blueprint $table) {
            $table->increments('recommended_action'); // Set as auto-incrementing primary key
            $table->string('value', 45);
        });

        // Insert initial values into recommend_action table
        DB::table('recommend_action')->insert([
            ['recommended_action' => 1, 'value' => 'Retention'],
            ['recommended_action' => 2, 'value' => 'Counseling'],
            ['recommended_action' => 3, 'value' => 'Pay Adjustment'],
            ['recommended_action' => 4, 'value' => 'Training'],
            ['recommended_action' => 5, 'value' => 'Transfer'],
            ['recommended_action' => 6, 'value' => 'Others'],
        ]);

        // Create employee_evaluation table
        Schema::create('employee_evaluation', function (Blueprint $table) {
            $table->increments('evaluation_ID'); // unsigned, auto-increment
            $table->string('evaluation_type', 45);
            $table->integer('employee_ID');
            $table->string('employee_dept', 45);
            $table->integer('rater_ID');
            $table->date('date_evaluated');
            $table->date('evaluation_start');
            $table->date('evaluation_end');
            $table->decimal('performance_rating', 5, 2);
            $table->string('remark_offense', 100)->nullable();
            $table->string('remark_accomplish', 100)->nullable();
            $table->string('remark_forimprove', 100)->nullable();
            $table->string('comment_rater', 150)->nullable();
            $table->string('comment_ratee', 150)->nullable();
            $table->unsignedInteger('recommended_action'); // Ensure it's unsigned

            // Define the foreign key constraint
            $table->foreign('recommended_action')
                ->references('recommended_action')->on('recommend_action')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });

        // Create evaluation_scale table
        Schema::create('evaluation_scale', function (Blueprint $table) {
            $table->unsignedInteger('evaluation_ID')->primary(); // Define primary key
            $table->decimal('sectionA_1', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionA_2', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionA_3', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionA_4', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionB_1', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionB_2', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionC_1', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionC_2', 3, 2)->unsigned()->default(0.00);
            $table->decimal('sectionC_3', 3, 2)->unsigned()->default(0.00);

            // Define the foreign key constraint
            $table->foreign('evaluation_ID')
                ->references('evaluation_ID')->on('employee_evaluation')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    /**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
    public function down()
    {
        Schema::dropIfExists('evaluation_scale');
        Schema::dropIfExists('employee_evaluation');
        Schema::dropIfExists('recommend_action');
    }
}

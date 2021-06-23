<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderNumberToWorkbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workbooks', function (Blueprint $table) {
            $table->after('project_id', function ($table){
                $table->integer('order_number')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workbooks', function (Blueprint $table) {
            $table->dropColumn('order_number');
        });
    }
}

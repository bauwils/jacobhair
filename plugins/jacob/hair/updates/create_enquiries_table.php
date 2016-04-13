<?php namespace Jacob\Hair\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateEnquiriesTable extends Migration
{

    public function up()
    {
        Schema::create('jacob_hair_enquiries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->text('comment');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jacob_hair_enquiries');
    }

}

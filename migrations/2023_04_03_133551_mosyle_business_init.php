<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class MosyleBusinessInit extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->create('mosyle_business', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number');
            $table->string('version')->nullable();
            $table->string('org_name')->nullable();
            $table->string('attempt_date')->nullable();
            $table->string('success_date')->nullable();
            $table->boolean('location_enabled')->nullable();

            $table->unique('serial_number');
            $table->index('version');
            $table->index('org_name');
            $table->index('attempt_date');
            $table->index('success_date');
            $table->index('location_enabled');

        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('mosyle_business');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateApiKeysTable
 */
class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('api_keys', static function (Blueprint $table): void {
           $table->bigIncrements('id');
           $table->nullableMorphs('apikeyable');
           $table->string('service_naam');
           $table->string('sleutel', 50)->unique();
           $table->string('laatste_ip_address', 50)->nullable();
           $table->string('laast_gebruikt_op')->nullable();
           $table->nullableTimestamps();
           $table->softDeletes();
           $table->index('sleutel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
}

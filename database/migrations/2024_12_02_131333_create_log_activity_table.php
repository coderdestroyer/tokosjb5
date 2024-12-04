<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_activity', function (Blueprint $table) {
            $table->id('log_id'); // kolom log_id dengan auto increment
            $table->timestamp('log_time')->default(DB::raw('CURRENT_TIMESTAMP')); // waktu log
            $table->string('name'); // nama pengguna yang melakukan aktivitas
            $table->string('log_target'); // target log
            $table->text('log_description')->nullable(); // deskripsi log
            $table->enum('activity_type', ['insert', 'update', 'delete']); // jenis aktivitas
            $table->text('old_value')->nullable(); // nilai lama (untuk update dan delete)
            $table->text('new_value')->nullable(); // nilai baru (untuk insert dan update)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_activity');
    }
}

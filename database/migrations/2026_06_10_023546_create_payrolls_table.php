<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Databaseyrol\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payrolls', function ( $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('period');
            $table->decimal('allowance',15,2);
            $table->decimal('deduction',15.2);
            $table->decimal('net_salary',15,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};

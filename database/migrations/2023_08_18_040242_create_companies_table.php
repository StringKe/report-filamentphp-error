<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');

            $table->string('logo')
                ->nullable();
            $table->string('slogan')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->string('website')
                ->nullable();
            $table->string('tax_number')
                ->nullable();
            $table->string('address')
                ->nullable();
            $table->json('addresses')
                ->nullable();
            $table->json('contract')
                ->nullable();
            $table->json('socials')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('role')
                ->default('user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_user');
        Schema::dropIfExists('companies');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->string('issuer')->nullable();
            $table->date('issued_at')->nullable();
            $table->string('credly_url')->nullable();
            $table->text('embed_html')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Composite index to support public listing queries
            $table->index(['is_published', 'sort_order', 'issued_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};

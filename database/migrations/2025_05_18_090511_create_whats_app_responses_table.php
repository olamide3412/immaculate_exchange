<?php

use App\Enums\MatchTypeEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('whats_app_responses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('triggers');
            $table->text('response');
            $table->boolean('is_active')->default(true);
            $table->enum('match_type', [MatchTypeEnums::Exact->value, MatchTypeEnums::Contains->value])->default(MatchTypeEnums::Exact->value); // 'exact' or 'contains'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whats_app_responses');
    }
};

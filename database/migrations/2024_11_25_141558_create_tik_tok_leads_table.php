<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tik_tok_leads', function (Blueprint $table) {
            $table->id();
            $table->string("page_id")->nullable();
            $table->string("page_name")->nullable();
            $table->string("campaign_id")->nullable();
            $table->string("campaign_name")->nullable();
            $table->string("adgroup_id")->nullable();
            $table->string("adgroup_name")->nullable();
            $table->string("ad_id")->nullable();
            $table->string("ad_name")->nullable();
            $table->dateTime("create_time")->nullable();
            $table->string("advertiser_id")->nullable();
            $table->string("advertiser_name")->nullable();
            $table->string("library_id")->nullable();
            $table->json("form_values");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tik_tok_leads');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayuTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('payu_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->text('body');
            $table->string('destination');
            $table->text('response')->nullable();
            $table->enum('status', ['pending', 'failed', 'successful', 'invalid'])->default('pending')->index();
            $table->timestamp('verified_at')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }
}

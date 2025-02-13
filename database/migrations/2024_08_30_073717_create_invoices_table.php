<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('type')->default('invoice');
            $table->string('invoice_number')->nullable();
            $table->longText('bill_from')->nullable();
            $table->longText('bill_to')->nullable();
            $table->string('logo')->nullable();
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->double('subtotal')->default(0);
            $table->double('discount')->default(0);
            $table->string('discount_reason')->nullable();
            $table->string('discount_type')->nullable();
            $table->double('shipping')->default(0);
            $table->string('shipping_method')->nullable();
            $table->double('tax')->default(0);
            $table->string('tax_name')->default(0);
            $table->double('total')->default(0);
            $table->longText('notes')->nullable();
            $table->longText('payment_method')->nullable();
            $table->string('sign')->default(0);
            $table->longText('items')->nullable();
            $table->string('save_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}

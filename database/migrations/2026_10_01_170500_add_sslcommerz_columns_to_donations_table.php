<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('donations', 'tran_id') && Schema::hasColumn('donations', 'paid_at')) {
            return;
        }

        Schema::table('donations', function (Blueprint $table) {
            if (! Schema::hasColumn('donations', 'tran_id')) {
                $table->string('tran_id', 30)->nullable()->unique()->after('image');
            }
            if (! Schema::hasColumn('donations', 'payment_status')) {
                $table->string('payment_status', 20)->nullable()->after('tran_id');
            }
            if (! Schema::hasColumn('donations', 'payment_currency')) {
                $table->string('payment_currency', 10)->nullable()->after('payment_status');
            }
            if (! Schema::hasColumn('donations', 'paid_amount')) {
                $table->decimal('paid_amount', 15, 2)->nullable()->after('payment_currency');
            }
            if (! Schema::hasColumn('donations', 'val_id')) {
                $table->string('val_id')->nullable()->after('paid_amount');
            }
            if (! Schema::hasColumn('donations', 'bank_tran_id')) {
                $table->string('bank_tran_id')->nullable()->after('val_id');
            }
            if (! Schema::hasColumn('donations', 'card_type')) {
                $table->string('card_type')->nullable()->after('bank_tran_id');
            }
            if (! Schema::hasColumn('donations', 'card_no')) {
                $table->string('card_no')->nullable()->after('card_type');
            }
            if (! Schema::hasColumn('donations', 'card_issuer')) {
                $table->string('card_issuer')->nullable()->after('card_no');
            }
            if (! Schema::hasColumn('donations', 'payment_message')) {
                $table->string('payment_message')->nullable()->after('card_issuer');
            }
            if (! Schema::hasColumn('donations', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('payment_message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropUnique(['tran_id']);
            $table->dropColumn([
                'tran_id',
                'payment_status',
                'payment_currency',
                'paid_amount',
                'val_id',
                'bank_tran_id',
                'card_type',
                'card_no',
                'card_issuer',
                'payment_message',
                'paid_at',
            ]);
        });
    }
};

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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->string('banner_image')->nullable();
            $table->dateTime('event_date');
            $table->dateTime('end_date')->nullable();
            $table->string('venue_name');
            $table->text('venue_address');
            $table->string('status')->default('active'); // active, sold_out, ended
            $table->timestamps();
        });

        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('total_quantity');
            $table->integer('available_quantity');
            $table->string('badge')->nullable(); // e.g., BEST SELLER, VIP
            $table->string('color')->default('#4f46e5'); // Hex color for styling
            $table->json('perks')->nullable(); // List of perks in json array
            $table->integer('max_per_order')->default(5);
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('booking_code')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_status')->default('paid'); // paid, pending, cancelled
            $table->string('payment_method')->default('promptpay'); // promptpay, credit_card
            $table->timestamp('paid_at')->nullable();
            $table->string('qr_token')->unique();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->cascadeOnDelete();
            $table->string('ticket_code')->unique();
            $table->string('attendee_name');
            $table->decimal('price', 10, 2);
            $table->boolean('is_checked_in')->default(false);
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('ticket_types');
        Schema::dropIfExists('events');
    }
};

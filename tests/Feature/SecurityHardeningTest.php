<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityHardeningTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_responses_include_security_headers(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY')
            ->assertHeader('Referrer-Policy', 'no-referrer');
    }

    public function test_ticket_codes_are_rendered_locally_and_not_cached(): void
    {
        $booking = Booking::firstOrFail();

        $this->get(route('tickets.show', $booking->booking_code))
            ->assertOk()
            ->assertHeader('Cache-Control', 'no-store, private')
            ->assertSee('data:image/svg+xml;base64,', false)
            ->assertDontSee('api.qrserver.com');
    }

    public function test_booking_is_disabled_when_demo_payments_are_disabled(): void
    {
        config(['services.demo_payments_enabled' => false]);

        $this->post(route('booking.store'))
            ->assertStatus(503);
    }
}
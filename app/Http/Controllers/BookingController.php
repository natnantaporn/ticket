<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Event;
use App\Models\TicketType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        abort_unless(
            config('services.demo_payments_enabled') && !app()->isProduction(),
            503,
            'Online payments are not configured.'
        );

        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'payment_method' => ['required', 'in:promptpay,credit_card'],
            'tickets' => ['required', 'array'],
            'tickets.*' => ['integer', 'min:0'],
        ], [
            'customer_name.required' => 'กรุณาระบุชื่อ-นามสกุลผู้จอง',
            'customer_email.required' => 'กรุณาระบุอีเมล',
            'customer_email.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'customer_phone.required' => 'กรุณาระบุเบอร์โทรศัพท์ติดต่อ',
            'tickets.required' => 'กรุณาเลือกบัตรอย่างน้อย 1 ใบ',
        ]);

        $event = Event::findOrFail($validated['event_id']);

        if ($event->status !== 'active' || $event->event_date->isPast()) {
            return back()->with('error', 'ขออภัย งานนี้ปิดรับจองแล้ว')->withInput();
        }
        
        // Filter ticket selections with quantity > 0
        $selectedTickets = array_filter($validated['tickets'], function ($qty) {
            return $qty > 0;
        });

        if (empty($selectedTickets)) {
            return back()->with('error', 'กรุณาเลือกจำนวนบัตรที่ต้องการจองอย่างน้อย 1 ใบ')->withInput();
        }

        try {
            $booking = DB::transaction(function () use ($validated, $selectedTickets, $event, $request) {
                $totalAmount = 0;
                $itemsToCreate = [];

                foreach ($selectedTickets as $ticketTypeId => $qty) {
                    $ticketType = TicketType::lockForUpdate()->findOrFail($ticketTypeId);

                    if ($ticketType->event_id != $event->id) {
                        throw new \Exception('ประเภทบัตรไม่ถูกต้องสำหรับงานนี้');
                    }

                    if ($qty > $ticketType->max_per_order) {
                        throw new \Exception("บัตร {$ticketType->name} จำกัดไม่เกิน {$ticketType->max_per_order} ใบต่อการจอง");
                    }

                    if ($ticketType->available_quantity < $qty) {
                        throw new \Exception("ขออภัย บัตร {$ticketType->name} มีจำนวนคงเหลือไม่เพียงพอ (เหลือเพียง {$ticketType->available_quantity} ใบ)");
                    }

                    // Decrement quantity
                    $ticketType->decrement('available_quantity', $qty);

                    for ($i = 1; $i <= $qty; $i++) {
                        $linePrice = $ticketType->price;
                        $totalAmount += $linePrice;

                        $itemsToCreate[] = [
                            'ticket_type' => $ticketType,
                            'price' => $linePrice,
                        ];
                    }
                }

                $bookingCode = 'TK-' . strtoupper(Str::random(16));
                $qrToken = 'QR-' . Str::uuid()->toString();

                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'event_id' => $event->id,
                    'booking_code' => $bookingCode,
                    'customer_name' => $validated['customer_name'],
                    'customer_email' => $validated['customer_email'],
                    'customer_phone' => $validated['customer_phone'],
                    'total_amount' => $totalAmount,
                    'payment_status' => 'paid', // Simulated instant checkout success
                    'payment_method' => $validated['payment_method'],
                    'paid_at' => Carbon::now(),
                    'qr_token' => $qrToken,
                    'notes' => 'ทำรายการจองและชำระเงินสำเร็จผ่าน ' . ($validated['payment_method'] === 'promptpay' ? 'พร้อมเพย์ QR' : 'บัตรเครดิต/เดบิต'),
                ]);

                // Create booking items
                foreach ($itemsToCreate as $index => $itemData) {
                    $seq = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                    $ticketCode = 'TKT-' . strtoupper(Str::random(4)) . '-' . $bookingCode . '-' . $seq;
                    
                    BookingItem::create([
                        'booking_id' => $booking->id,
                        'ticket_type_id' => $itemData['ticket_type']->id,
                        'ticket_code' => $ticketCode,
                        'attendee_name' => $validated['customer_name'] . ($index > 0 ? " (ผู้ติดตาม #{$index})" : ''),
                        'price' => $itemData['price'],
                        'is_checked_in' => false,
                    ]);
                }

                return $booking;
            });

            return redirect()->route('tickets.show', $booking->booking_code)
                ->with('success', '🎉 จองตั๋วและชำระเงินสำเร็จเรียบร้อย! รหัสการจอง: ' . $booking->booking_code);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}

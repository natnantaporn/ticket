<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Event;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::create([
            'name' => 'ผู้ดูแลระบบ (Admin)',
            'email' => 'admin@ticket.test',
            'phone' => '081-999-8888',
            'role' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        // 2. Create Demo User
        $demoUser = User::create([
            'name' => 'สมชาย สายปาร์ตี้',
            'email' => 'user@ticket.test',
            'phone' => '089-123-4567',
            'role' => 'user',
            'password' => Hash::make('password123'),
        ]);

        // 3. Create Event
        $eventDate = Carbon::now()->addDays(42)->setHour(17)->setMinute(0);
        $endDate = (clone $eventDate)->addHours(8);

        $event = Event::create([
            'title' => 'NEON PULSE MUSIC & TECH FESTIVAL 2026',
            'slug' => 'neon-pulse-2026',
            'tagline' => 'เทศกาลดนตรีอิเล็กทรอนิกส์ & นวัตกรรมแสงเลเซอร์ 360 องศา แห่งอนาคต',
            'description' => 'เตรียมตัวสัมผัสประสบการณ์ระดับเวิลด์คลาสกับเทศกาลดนตรีอิเล็กทรอนิกส์และเทคโนโลยีดิจิทัลที่ยิ่งใหญ่ที่สุดแห่งปี! รวมทัพดีเจระดับแนวหน้าของโลก พร้อมนวัตกรรมเวทีแสงเลเซอร์ Hologram และระบบเสียงกระหึ่มรอบทิศทาง 360 องศา พร้อมโซน Interactive Art Exhibition และ Food & Beverage Village ครบครันตลอดคืน',
            'banner_image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=1600&q=80',
            'event_date' => $eventDate,
            'end_date' => $endDate,
            'venue_name' => 'Impact Arena Exhibition Hall 9-10',
            'venue_address' => 'ถนนป๊อปปูล่า ตำบลบ้านใหม่ อำเภอปากเกร็ด นนทบุรี 11120',
            'status' => 'active',
        ]);

        // 4. Create Ticket Types
        $ticketTypes = [
            [
                'event_id' => $event->id,
                'name' => 'SUPER VVIP PASS (FRONT ROW)',
                'description' => 'บัตรระดับสูงสุด โซนติดขอบเวที พร้อมสิทธิพิเศษครบครันระดับ World-class',
                'price' => 4500,
                'total_quantity' => 50,
                'available_quantity' => 38,
                'badge' => 'EXCLUSIVE VVIP',
                'color' => '#ec4899',
                'max_per_order' => 4,
                'perks' => [
                    'โซนยืนแถวหน้าสุดติดขอบเวที (Front Row Pit)',
                    'เข้างานช่องทางด่วนพิเศษ Fast Track Priority Lane',
                    'เข้า VVIP Air-conditioned Lounge พร้อมเครื่องดื่ม & Snack ฟรีตลอดคืน',
                    'ของที่ระลึก Limited Edition Neon Kit + ป้ายชื่อคล้องคอ VVIP Card',
                    'สิทธิ์ลุ้น Meet & Greet และถ่ายรูปกับศิลปิน Headliner'
                ],
            ],
            [
                'event_id' => $event->id,
                'name' => 'VIP EXPERIENCE PASS',
                'description' => 'โซนยกพื้น Elevated Platform มองเห็นเวทีชัดเจน 100% มุมมองสวยงามที่สุด',
                'price' => 2800,
                'total_quantity' => 150,
                'available_quantity' => 84,
                'badge' => 'POPULAR CHOICE',
                'color' => '#8b5cf6',
                'max_per_order' => 5,
                'perks' => [
                    'เข้าชมบนแท่นยกพื้น VIP Platform มองเห็นเวทีและเลเซอร์เต็มตา',
                    'ช่องทางเข้าพิเศษ VIP Gate',
                    'Welcome Drink ฟรี 2 แก้ว (Cocktail / Mocktail)',
                    'สายรัดข้อมือเรืองแสงอัจฉริยะ LED DMX Sync จังหวะดนตรี'
                ],
            ],
            [
                'event_id' => $event->id,
                'name' => 'REGULAR STANDING PASS',
                'description' => 'บัตรยืนโซนมาตรฐาน เต็มอิ่มกับบรรยากาศความมันส์ใจกลางฮอลล์ใหญ่',
                'price' => 1500,
                'total_quantity' => 500,
                'available_quantity' => 312,
                'badge' => 'BEST SELLER',
                'color' => '#06b6d4',
                'max_per_order' => 6,
                'perks' => [
                    'เข้าชมพื้นที่ลานคอนเสิร์ตใหญ่ Regular Zone A / B',
                    'สายรัดข้อมือ RFID เข้างาน',
                    'เข้าถึงโซน Food Village และ Interactive Light Zone'
                ],
            ],
            [
                'event_id' => $event->id,
                'name' => 'EARLY BIRD PASS (LIMITED)',
                'description' => 'บัตรราคาพิเศษช่วงพรีเซลสุดคุ้ม มีจำนวนจำกัดเฉพาะช่วงเปิดตัว',
                'price' => 990,
                'total_quantity' => 100,
                'available_quantity' => 8,
                'badge' => 'ALMOST SOLD OUT',
                'color' => '#f59e0b',
                'max_per_order' => 4,
                'perks' => [
                    'ราคาพิเศษคุ้มค่าที่สุด ประหยัดกว่า 35%',
                    'เข้าชมพื้นที่ Regular Zone ทั่วทั้งฮอลล์',
                    'รับฟรี Exclusive Festival Hologram Sticker'
                ],
            ],
        ];

        $createdTicketTypes = [];
        foreach ($ticketTypes as $data) {
            $createdTicketTypes[] = TicketType::create($data);
        }

        // 5. Create Sample Booking for Demo User
        $bookingCode = 'TK-' . strtoupper(Str::random(8));
        $qrToken = 'QR-' . Str::uuid()->toString();

        $booking = Booking::create([
            'user_id' => $demoUser->id,
            'event_id' => $event->id,
            'booking_code' => $bookingCode,
            'customer_name' => $demoUser->name,
            'customer_email' => $demoUser->email,
            'customer_phone' => $demoUser->phone,
            'total_amount' => 5800.00,
            'payment_status' => 'paid',
            'payment_method' => 'promptpay',
            'paid_at' => Carbon::now()->subHours(3),
            'qr_token' => $qrToken,
            'notes' => 'ชำระเงินสำเร็จผ่านพร้อมเพย์ QR Code',
        ]);

        // Item 1: VVIP
        BookingItem::create([
            'booking_id' => $booking->id,
            'ticket_type_id' => $createdTicketTypes[0]->id,
            'ticket_code' => 'TKT-' . strtoupper(Str::random(10)),
            'attendee_name' => 'สมชาย สายปาร์ตี้',
            'price' => 4500.00,
            'is_checked_in' => false,
        ]);

        // Item 2: Regular
        BookingItem::create([
            'booking_id' => $booking->id,
            'ticket_type_id' => $createdTicketTypes[2]->id,
            'ticket_code' => 'TKT-' . strtoupper(Str::random(10)),
            'attendee_name' => 'วิภาดา พาเพลิน',
            'price' => 1300.00,
            'is_checked_in' => false,
        ]);
    }
}

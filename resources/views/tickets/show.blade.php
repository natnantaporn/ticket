@extends('layouts.app')

@section('title', 'E-Ticket: ' . $booking->booking_code . ' - ' . $booking->event->title)

@section('content')
<div class="container" style="padding-top: 3rem; padding-bottom: 5rem;">
    <!-- Top Action Bar -->
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 800px; margin: 0 auto 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
            <i data-lucide="arrow-left" style="width: 16px; height: 16px;"></i>
            <span>กลับสู่หน้าหลัก</span>
        </a>

        <div style="display: flex; gap: 0.75rem;">
            <button onclick="window.print()" class="btn btn-primary btn-sm btn-print">
                <i data-lucide="printer" style="width: 16px; height: 16px;"></i>
                <span>พิมพ์บัตร E-Ticket / PDF</span>
            </button>
            @auth
                <a href="{{ route('tickets.my') }}" class="btn btn-secondary btn-sm">
                    <i data-lucide="list" style="width: 16px; height: 16px;"></i>
                    <span>ตั๋วทั้งหมดของฉัน</span>
                </a>
            @endauth
        </div>
    </div>

    <!-- E-Tickets List -->
    @foreach($booking->items as $index => $item)
        <div class="ticket-pass-wrapper">
            <div class="ticket-pass" @style(['border-top' => '4px solid '.($item->ticketType->color ?? '#6366f1')])>
                <!-- Main Body -->
                <div class="ticket-pass-main">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.5rem;">
                        <div>
                            <span @style(['font-size' => '0.75rem', 'font-weight' => '800', 'letter-spacing' => '1px', 'text-transform' => 'uppercase', 'color' => $item->ticketType->color ?? '#38bdf8'])>
                                OFFICIAL E-TICKET PASS • ใบที่ {{ $index + 1 }}/{{ $booking->items->count() }}
                            </span>
                            <h2 style="font-size: 1.6rem; font-weight: 800; margin-top: 0.25rem;">
                                {{ $booking->event->title }}
                            </h2>
                        </div>
                        <div style="text-align: right;">
                            <span style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: var(--radius-full); font-size: 0.8rem; font-weight: 700; background: rgba(16, 185, 129, 0.15); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3);">
                                <i data-lucide="check-circle-2" style="width: 12px; height: 12px; display: inline-block; vertical-align: middle;"></i> ยืนยันแล้ว
                            </span>
                        </div>
                    </div>

                    <!-- Event & Attendee Info Grid -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.25rem; margin-bottom: 1.75rem; background: rgba(255, 255, 255, 0.03); padding: 1.25rem; border-radius: var(--radius-md); border: 1px solid var(--border-glass);">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; font-weight: 600;">ชื่อผู้เข้าร่วมงาน</span>
                            <p style="font-size: 1.1rem; font-weight: 700; color: #fff; margin-top: 0.15rem;">{{ $item->attendee_name }}</p>
                        </div>
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; font-weight: 600;">ประเภทบัตร / โซน</span>
                            <p @style(['font-size' => '1.1rem', 'font-weight' => '700', 'color' => $item->ticketType->color ?? '#38bdf8', 'margin-top' => '0.15rem'])>
                                {{ $item->ticketType->name }}
                            </p>
                        </div>
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; font-weight: 600;">วันและเวลาจัดงาน</span>
                            <p style="font-size: 0.95rem; font-weight: 600; color: #fff; margin-top: 0.15rem;">
                                {{ $booking->event->event_date->format('d M Y') }} • 17:00 น.
                            </p>
                        </div>
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-dim); text-transform: uppercase; font-weight: 600;">สถานที่จัดงาน</span>
                            <p style="font-size: 0.95rem; font-weight: 600; color: #fff; margin-top: 0.15rem;">
                                {{ $booking->event->venue_name }}
                            </p>
                        </div>
                    </div>

                    <!-- Security Info & Perks -->
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem;">
                        <div>
                            <span style="font-size: 0.75rem; color: var(--text-dim);">รหัสบัตรเฉพาะใบ (Ticket ID)</span>
                            <p style="font-family: monospace; font-size: 0.95rem; color: #a5b4fc; font-weight: 700;">{{ $item->ticket_code }}</p>
                            <span style="font-size: 0.75rem; color: var(--text-dim);">รหัสการจอง: {{ $booking->booking_code }} • ชำระผ่าน {{ strtoupper($booking->payment_method) }}</span>
                        </div>
                        <div style="text-align: right;">
                            <span style="font-size: 0.75rem; color: var(--text-dim);">มูลค่าบัตร</span>
                            <p style="font-size: 1.3rem; font-weight: 800; color: #fff;">฿{{ number_format($item->price) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stub with QR Code & Notch -->
                <div class="ticket-pass-stub">
                    <span style="font-size: 0.75rem; color: var(--text-dim); margin-bottom: 0.75rem; font-weight: 700; letter-spacing: 1px;">
                        SCAN TO ENTER
                    </span>

                    <img src="{{ $ticketQrCodes[$item->id] }}"
                         alt="QR Code" 
                         class="ticket-qr-img">

                    <p style="font-family: monospace; font-size: 0.75rem; color: var(--text-muted); margin-top: 0.75rem;">
                        {{ $item->ticket_code }}
                    </p>

                    <div class="barcode-strip"></div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Instructions Card -->
    <div style="max-width: 780px; margin: 2rem auto 0; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border-glass); border-radius: var(--radius-lg); padding: 1.5rem 2rem;">
        <h4 style="font-size: 1rem; color: #38bdf8; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <i data-lucide="info" style="width: 18px; height: 18px;"></i>
            คำแนะนำสำหรับวันเข้างาน
        </h4>
        <ul style="color: var(--text-muted); font-size: 0.88rem; list-style-position: inside; display: flex; flex-direction: column; gap: 0.4rem;">
            <li>แสดงหน้าจอมือถือหรือเอกสารฉบับพิมพ์นี้พร้อมบัตรประชาชนต่อเจ้าหน้าที่เพื่อรับสายรัดข้อมือ RFID</li>
            <li>QR Code แต่ละใบสามารถสแกนผ่านประตูได้เพียง 1 ครั้งเท่านั้น ห้ามส่งต่อให้ผู้อื่น</li>
            <li>หากมีข้อสงสัย ติดต่อฝ่ายบริการลูกค้าที่ support@neontix.test หรือโทร 02-999-8888</li>
        </ul>
    </div>
</div>
@endsection

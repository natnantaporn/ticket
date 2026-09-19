@extends('layouts.app')

@section('title', 'ตั๋วของฉัน (My Tickets) - NEONTIX')

@section('content')
<div class="container" style="padding-top: 3.5rem; padding-bottom: 5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span class="section-subtitle">MY BOOKINGS</span>
            <h1 style="font-size: 2.2rem; font-weight: 800;">ประวัติการจองและตั๋วของฉัน</h1>
        </div>
        <a href="{{ route('home') }}#tickets" class="btn btn-primary">
            <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i>
            <span>จองบัตรเพิ่ม</span>
        </a>
    </div>

    @if($bookings->isEmpty())
        <div class="glass-panel" style="padding: 4rem 2rem; text-align: center;">
            <div style="background: rgba(255, 255, 255, 0.05); width: 72px; height: 72px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i data-lucide="ticket" style="width: 36px; height: 36px; color: var(--text-dim);"></i>
            </div>
            <h3 style="font-size: 1.4rem; margin-bottom: 0.5rem;">ยังไม่มีประวัติการจองตั๋ว</h3>
            <p style="color: var(--text-muted); max-width: 420px; margin: 0 auto 1.5rem;">
                คุณยังไม่ได้ทำการจองบัตรงานอีเวนต์ เลือกดูรายการบัตรในหน้าหลักและจองได้ทันที
            </p>
            <a href="{{ route('home') }}#tickets" class="btn btn-primary">
                เลือกชมบัตรอีเวนต์
            </a>
        </div>
    @else
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($bookings as $booking)
                <div class="glass-panel glass-panel-hover" style="padding: 2rem; border-left: 4px solid #6366f1;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1.5rem;">
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                <span style="font-family: monospace; font-size: 1rem; font-weight: 700; color: #38bdf8;">
                                    #{{ $booking->booking_code }}
                                </span>
                                <span style="display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.25rem 0.75rem; border-radius: var(--radius-full); font-size: 0.78rem; font-weight: 700; background: rgba(16, 185, 129, 0.15); color: #34d399;">
                                    <i data-lucide="check" style="width: 12px; height: 12px;"></i> ชำระเงินเรียบร้อย
                                </span>
                            </div>

                            <h3 style="font-size: 1.4rem; margin-bottom: 0.5rem;">{{ $booking->event->title }}</h3>
                            <p style="color: var(--text-muted); font-size: 0.9rem;">
                                <i data-lucide="calendar" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle;"></i>
                                {{ $booking->event->event_date->format('d M Y') }} • {{ $booking->event->venue_name }}
                            </p>

                            <!-- Breakdown of items in this booking -->
                            <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                @foreach($booking->items as $item)
                                    <span style="background: rgba(255, 255, 255, 0.06); padding: 0.35rem 0.85rem; border-radius: var(--radius-sm); font-size: 0.85rem; border: 1px solid var(--border-glass);">
                                        <strong>{{ $item->ticketType->name }}</strong>: {{ $item->attendee_name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <div style="text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 0.75rem;">
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-dim);">ยอดรวมทั้งสิ้น ({{ $booking->items->count() }} ใบ)</span>
                                <div style="font-size: 1.6rem; font-weight: 800; color: #10b981;">
                                    ฿{{ number_format($booking->total_amount) }}
                                </div>
                            </div>

                            <a href="{{ route('tickets.show', $booking->booking_code) }}" class="btn btn-primary btn-sm">
                                <i data-lucide="qr-code" style="width: 16px; height: 16px;"></i>
                                <span>เปิดดู E-Ticket</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

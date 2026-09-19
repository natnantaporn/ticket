@extends('layouts.app')

@section('title', 'ระบบจัดการบัตรและผู้เข้าร่วมงาน (Admin Dashboard)')

@section('content')
<div class="container" style="padding-top: 3rem; padding-bottom: 5rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span class="section-subtitle">ADMIN CONTROL PANEL</span>
            <h1 style="font-size: 2.2rem; font-weight: 800;">แดชบอร์ดจัดการอีเวนต์ & การจองตั๋ว</h1>
        </div>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">
                <i data-lucide="external-link" style="width: 16px; height: 16px;"></i>
                <span>ดูหน้าเว็บหลัก</span>
            </a>
        </div>
    </div>

    <!-- Stat Metric Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        <div class="glass-panel" style="padding: 1.5rem; border-left: 4px solid #10b981;">
            <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">ยอดขายรวมทั้งหมด</span>
            <div style="font-size: 2.2rem; font-weight: 800; color: #10b981; margin: 0.35rem 0;">
                ฿{{ number_format($totalRevenue) }}
            </div>
            <span style="font-size: 0.8rem; color: var(--text-dim);">ชำระเงินสำเร็จแล้ว 100%</span>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-left: 4px solid #6366f1;">
            <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">จำนวนรายการสั่งจอง</span>
            <div style="font-size: 2.2rem; font-weight: 800; color: #818cf8; margin: 0.35rem 0;">
                {{ number_format($totalBookings) }}
            </div>
            <span style="font-size: 0.8rem; color: var(--text-dim);">ออเดอร์ทั้งหมดในระบบ</span>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-left: 4px solid #06b6d4;">
            <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">จำนวนบัตรที่จำหน่ายได้</span>
            <div style="font-size: 2.2rem; font-weight: 800; color: #22d3ee; margin: 0.35rem 0;">
                {{ number_format($totalTicketsSold) }}
            </div>
            <span style="font-size: 0.8rem; color: var(--text-dim);">ใบ</span>
        </div>

        <div class="glass-panel" style="padding: 1.5rem; border-left: 4px solid #f59e0b;">
            <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">เช็คอินเข้างานแล้ว</span>
            <div style="font-size: 2.2rem; font-weight: 800; color: #fbbf24; margin: 0.35rem 0;">
                {{ number_format($totalCheckedIn) }} / {{ number_format($totalTicketsSold) }}
            </div>
            <span style="font-size: 0.8rem; color: var(--text-dim);">สถานะสแกนผ่านประตู</span>
        </div>
    </div>

    <!-- Ticket Inventory Overview -->
    <div class="glass-panel" style="padding: 2rem; margin-bottom: 2.5rem;">
        <h3 style="font-size: 1.3rem; margin-bottom: 1.25rem;">สถานะสต็อกประเภทบัตร (Ticket Stock)</h3>
        
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ประเภทบัตร</th>
                        <th>ราคาต่อใบ</th>
                        <th>โควต้าทั้งหมด</th>
                        <th>คงเหลือ</th>
                        <th>ขายแล้ว</th>
                        <th>ความคืบหน้ายอดขาย</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticketTypes as $tt)
                        @php
                            $sold = $tt->total_quantity - $tt->available_quantity;
                            $percent = $tt->total_quantity > 0 ? round(($sold / $tt->total_quantity) * 100) : 0;
                        @endphp
                        <tr>
                            <td>
                                <strong style="color: {{ $tt->color }};">{{ $tt->name }}</strong>
                            </td>
                            <td>฿{{ number_format($tt->price) }}</td>
                            <td>{{ number_format($tt->total_quantity) }}</td>
                            <td>
                                <span style="color: {{ $tt->available_quantity < 15 ? '#ef4444' : '#10b981' }}; font-weight: 700;">
                                    {{ number_format($tt->available_quantity) }}
                                </span>
                            </td>
                            <td>{{ number_format($sold) }}</td>
                            <td style="width: 220px;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="flex-grow: 1; height: 8px; background: rgba(255, 255, 255, 0.1); border-radius: 4px; overflow: hidden;">
                                        <div style="width: {{ $percent }}%; height: 100%; background: {{ $tt->color }};"></div>
                                    </div>
                                    <span style="font-size: 0.8rem; font-weight: 600;">{{ $percent }}%</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Bookings and Gate Check-In -->
    <div class="glass-panel" style="padding: 2rem;">
        <h3 style="font-size: 1.3rem; margin-bottom: 1.25rem;">รายการจองและจุดสแกนเช็คอิน (Door Check-In)</h3>
        
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>รหัสการจอง</th>
                        <th>ผู้จอง / ข้อมูลติดต่อ</th>
                        <th>ยอดเงิน</th>
                        <th>วิธีชำระ</th>
                        <th>เวลาจอง</th>
                        <th>ผู้ถือบัตร / สถานะเช็คอินประตู</th>
                        <th>การกระทำ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                        <tr>
                            <td>
                                <span style="font-family: monospace; font-weight: 700; color: #38bdf8;">
                                    {{ $b->booking_code }}
                                </span>
                            </td>
                            <td>
                                <div><strong>{{ $b->customer_name }}</strong></div>
                                <div style="font-size: 0.8rem; color: var(--text-dim);">
                                    {{ $b->customer_email }} • {{ $b->customer_phone }}
                                </div>
                            </td>
                            <td>
                                <strong style="color: #10b981;">฿{{ number_format($b->total_amount) }}</strong>
                            </td>
                            <td>
                                <span style="text-transform: uppercase; font-size: 0.8rem; background: rgba(255, 255, 255, 0.08); padding: 0.2rem 0.6rem; border-radius: 4px;">
                                    {{ $b->payment_method }}
                                </span>
                            </td>
                            <td style="font-size: 0.85rem; color: var(--text-muted);">
                                {{ $b->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    @foreach($b->items as $item)
                                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; background: rgba(255, 255, 255, 0.04); padding: 0.35rem 0.65rem; border-radius: 6px; font-size: 0.82rem;">
                                            <span>
                                                <strong>{{ $item->attendee_name }}</strong> 
                                                <small style="color: var(--text-dim);">({{ $item->ticketType->name }})</small>
                                            </span>

                                            <form action="{{ route('admin.checkin', $item->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @if($item->is_checked_in)
                                                    <button type="submit" class="btn btn-sm" style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 0.2rem 0.6rem; font-size: 0.75rem;">
                                                        <i data-lucide="check" style="width: 12px; height: 12px;"></i> เช็คอินแล้ว
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-secondary btn-sm" style="padding: 0.2rem 0.6rem; font-size: 0.75rem;">
                                                        สแกนเข้างาน
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('tickets.show', $b->booking_code) }}" target="_blank" class="btn btn-secondary btn-sm" title="เปิดดูตั๋ว">
                                    <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection

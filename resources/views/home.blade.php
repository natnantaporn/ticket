@extends('layouts.app')

@section('title', ($event ? $event->title : 'NEON PULSE 2026') . ' - ระบบจองตั๋วออนไลน์')

@section('content')
<div class="container">
    <!-- ================= HERO SECTION ================= -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="event-status-pill">
                <span class="pulse-dot"></span>
                <span>เปิดจำหน่ายบัตรแล้ว • EARLY BIRD มีจำนวนจำกัด</span>
            </div>

            <h1 class="hero-title text-gradient">
                {{ $event->title ?? 'NEON PULSE FESTIVAL 2026' }}
            </h1>

            <p class="hero-tagline">
                {{ $event->tagline ?? 'เทศกาลดนตรีอิเล็กทรอนิกส์ & นวัตกรรมแสงเลเซอร์ 360 องศา แห่งโลกอนาคต' }}
            </p>

            <div class="hero-meta-strip">
                <div class="meta-item">
                    <i data-lucide="calendar" style="width: 18px; height: 18px; color: var(--champagne);"></i>
                    <span>{{ $event->event_date->format('d M Y') }} (17:00 น. เป็นต้นไป)</span>
                </div>
                <div class="meta-item">
                    <i data-lucide="map-pin" style="width: 18px; height: 18px; color: #38bdf8;"></i>
                    <span>{{ $event->venue_name ?? 'Impact Arena Hall 9-10' }}</span>
                </div>
                <div class="meta-item">
                    <i data-lucide="gem" style="width: 18px; height: 18px; color: var(--champagne);"></i>
                    <span>Limited 2,500 Exclusive Passes</span>
                </div>
            </div>

            <!-- Countdown Timer -->
            <div class="countdown-container" id="countdown">
                <div class="countdown-box">
                    <div class="countdown-num" id="days">42</div>
                    <div class="countdown-label">วัน (Days)</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-num" id="hours">18</div>
                    <div class="countdown-label">ชั่วโมง (Hrs)</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-num" id="minutes">45</div>
                    <div class="countdown-label">นาที (Mins)</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-num" id="seconds">30</div>
                    <div class="countdown-label">วินาที (Secs)</div>
                </div>
            </div>

            <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                <a href="#tickets" class="btn btn-primary btn-lg">
                    <i data-lucide="sparkles" style="width: 20px; height: 20px;"></i>
                    <span>เลือกซื้อบัตรทันที</span>
                </a>
                <a href="#about" class="btn btn-secondary btn-lg">
                    <i data-lucide="info" style="width: 20px; height: 20px;"></i>
                    <span>ดูรายละเอียดงาน</span>
                </a>
            </div>

            <!-- Hero Image Banner -->
            <div class="hero-visual">
                <img src="{{ $event->banner_image ?? 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?auto=format&fit=crop&w=1600&q=80' }}" alt="Event Banner">
                <div class="hero-visual-overlay">
                    <div>
                        <span style="font-size: 0.85rem; color: var(--champagne); font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">Curated Audiovisual Masterpiece</span>
                        <h3 style="font-size: 1.8rem; font-weight: 800; color: #fff; margin-top: 0.35rem; letter-spacing: -0.02em;">
                            360° HYPER-STAGE AUDIOVISUAL EXPERIENCE
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= ABOUT & HIGHLIGHTS ================= -->
    <section class="section" id="about">
        <div class="section-header">
            <span class="section-subtitle">THE EXPERIENCE</span>
            <h2 class="section-title">ปรากฏการณ์ดนตรีแห่งปีที่ทุกคนรอคอย</h2>
            <p style="color: var(--text-muted); margin-top: 0.75rem;">
                {{ $event->description }}
            </p>
        </div>

        <div class="features-grid" id="highlights">
            <div class="feature-card">
                <div class="feature-icon-wrapper" style="background: rgba(226, 192, 121, 0.12); color: var(--champagne); border-color: rgba(226, 192, 121, 0.25);">
                    <i data-lucide="radio" style="width: 28px; height: 28px;"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.6rem;">360° Spatial Sound</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.65;">
                    ระบบเสียงรอบทิศทางระดับ Ultra-High Fidelity ซับเบสทรงพลัง สัมผัสทุกจังหวะดนตรีได้อย่างลึกซึ้ง
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper" style="background: rgba(192, 132, 252, 0.12); color: var(--aurora-purple); border-color: rgba(192, 132, 252, 0.25);">
                    <i data-lucide="zap" style="width: 28px; height: 28px;"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.6rem;">Hologram Symphony</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.65;">
                    การแสดงเลเซอร์และวิชวลโฮโลแกรมล้ำยุค นำเข้าจากเยอรมนี จัดเต็มกว่า 150 ตัวทั่วทั้งฮอลล์
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper" style="background: rgba(56, 189, 248, 0.12); color: var(--celestial-cyan); border-color: rgba(56, 189, 248, 0.25);">
                    <i data-lucide="music-2" style="width: 28px; height: 28px;"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.6rem;">20+ World-Class DJs</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.65;">
                    พบกับดีเจชื่อดังระดับ Top 100 DJ Mag พร้อมศิลปินรับเชิญพิเศษที่มาร่วมสร้างความตื่นตาตื่นใจ
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-wrapper" style="background: rgba(226, 192, 121, 0.15); color: var(--champagne-light); border-color: rgba(226, 192, 121, 0.35);">
                    <i data-lucide="gem" style="width: 28px; height: 28px;"></i>
                </div>
                <h3 style="font-size: 1.25rem; margin-bottom: 0.6rem;">Concierge & VIP Lounge</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.65;">
                    บริการระดับพรีเมียม ทางเข้าด่วนพิเศษ ห้องรับรองติดแอร์ และบริการเครื่องดื่มไม่อั้นตลอดงาน
                </p>
            </div>
        </div>
    </section>

    <!-- ================= TICKETS SELECTION MATRIX ================= -->
    <section class="section" id="tickets">
        <div class="section-header">
            <span class="section-subtitle">TICKETS & PACKAGES</span>
            <h2 class="section-title">เลือกประเภทบัตรและสำรองที่นั่ง</h2>
            <p style="color: var(--text-muted); margin-top: 0.75rem;">
                เลือกบัตรที่คุณต้องการ กรอกข้อมูล และรับ E-Ticket พร้อม QR Code เข้างานได้ทันที
            </p>
        </div>

        <form id="booking-selection-form" action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="tickets-grid">
                @foreach($event->ticketTypes as $ticket)
                    <div class="ticket-card" style="--ticket-color: {{ $ticket->color }}; --ticket-glow: {{ $ticket->color }}40;">
                        @if($ticket->badge)
                            <div class="ticket-badge" style="background: {{ $ticket->color }}25; color: {{ $ticket->color }}; border: 1px solid {{ $ticket->color }}60;">
                                {{ $ticket->badge }}
                            </div>
                        @endif

                        <h3 class="ticket-name">{{ $ticket->name }}</h3>
                        <p style="color: var(--text-muted); font-size: 0.85rem; min-height: 40px;">
                            {{ $ticket->description }}
                        </p>

                        <div class="ticket-price-wrap">
                            <span class="ticket-currency">฿</span>
                            <span class="ticket-price">{{ number_format($ticket->price) }}</span>
                            <span class="ticket-unit">/ ท่าน</span>
                        </div>

                        <div class="ticket-availability">
                            <span style="color: var(--text-muted);">คงเหลือ</span>
                            <span style="font-weight: 700; color: {{ $ticket->available_quantity < 15 ? '#f43f5e' : '#10b981' }};">
                                {{ $ticket->available_quantity }} / {{ $ticket->total_quantity }} ใบ
                            </span>
                        </div>

                        <ul class="ticket-perks">
                            @if(is_array($ticket->perks))
                                @foreach($ticket->perks as $perk)
                                    <li class="ticket-perk-item">
                                        <i data-lucide="check" class="perk-check" style="width: 16px; height: 16px;"></i>
                                        <span>{{ $perk }}</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                        <!-- Quantity Selector -->
                        @if($ticket->available_quantity > 0)
                            <div class="qty-control">
                                <button type="button" class="qty-btn" onclick="updateQty({{ $ticket->id }}, -1)">-</button>
                                <input type="number" 
                                       id="qty-input-{{ $ticket->id }}" 
                                       name="tickets[{{ $ticket->id }}]" 
                                       value="0" 
                                       min="0" 
                                       max="{{ min($ticket->available_quantity, $ticket->max_per_order) }}" 
                                       data-price="{{ $ticket->price }}"
                                       data-name="{{ $ticket->name }}"
                                       class="qty-input ticket-qty-counter" 
                                       readonly>
                                <button type="button" class="qty-btn" onclick="updateQty({{ $ticket->id }}, 1)">+</button>
                            </div>
                        @else
                            <button type="button" class="btn btn-secondary" style="width: 100%; opacity: 0.6; cursor: not-allowed;" disabled>
                                บัตรจำหน่ายหมดแล้ว
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Floating Booking Bar -->
            <div class="booking-summary-bar" id="booking-bar">
                <div class="container summary-flex">
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <div class="summary-price-box">
                            <span class="summary-label">ยอดรวมการจอง (<span id="total-qty-count">0</span> ใบ)</span>
                            <span class="summary-total">฿<span id="total-price-amount">0</span></span>
                        </div>
                        <div id="selected-tickets-preview" style="color: var(--text-dim); font-size: 0.85rem;"></div>
                    </div>

                    <div style="display: flex; gap: 0.75rem;">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="resetSelection()">ล้างค่า</button>
                        <button type="button" class="btn btn-primary btn-lg" onclick="openCheckoutModal()">
                            <i data-lucide="credit-card" style="width: 18px; height: 18px;"></i>
                            <span>ดำเนินการชำระเงิน</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- ================= CHECKOUT MODAL ================= -->
            <div class="modal-overlay" id="checkout-modal">
                <div class="modal-container">
                    <div class="modal-header">
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div class="logo-badge" style="width: 38px; height: 38px;">
                                <i data-lucide="shield-check" style="width: 20px; height: 20px; color: #fff;"></i>
                            </div>
                            <div>
                                <h3 style="font-size: 1.3rem;">ยืนยันข้อมูลและชำระเงิน</h3>
                                <p style="font-size: 0.85rem; color: var(--text-muted);">ระบบออกตั๋ว E-Ticket ปลอดภัย 100%</p>
                            </div>
                        </div>
                        <button type="button" class="modal-close" onclick="closeCheckoutModal()">&times;</button>
                    </div>

                    <!-- Order Summary Box -->
                    <div style="background: rgba(255, 255, 255, 0.04); border-radius: var(--radius-md); padding: 1.25rem; margin-bottom: 1.5rem; border: 1px solid var(--border-glass);">
                        <h4 style="font-size: 0.95rem; margin-bottom: 0.75rem; color: #38bdf8;">สรุปรายการบัตรที่เลือก</h4>
                        <div id="modal-order-items" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.9rem; margin-bottom: 0.75rem;">
                            <!-- Injected by JS -->
                        </div>
                        <div style="border-top: 1px solid var(--border-glass); padding-top: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-weight: 600;">ยอดชำระสุทธิ (รวมภาษี)</span>
                            <span style="font-size: 1.4rem; font-weight: 800; color: #10b981;">฿<span id="modal-total-price">0</span></span>
                        </div>
                    </div>

                    <!-- Buyer Info -->
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 0.95rem; margin-bottom: 1rem; color: #e2e8f0;">ข้อมูลผู้จองบัตร (สำหรับออก E-Ticket)</h4>
                        
                        <div class="form-group">
                            <label class="form-label" for="customer_name">ชื่อ - นามสกุล (ตรงตามบัตรประชาชน/พาสปอร์ต) *</label>
                            <input type="text" 
                                   id="customer_name" 
                                   name="customer_name" 
                                   class="form-control" 
                                   placeholder="เช่น สมชาย ใจดี" 
                                   value="{{ Auth::user() ? Auth::user()->name : old('customer_name') }}" 
                                   required>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label" for="customer_email">อีเมลรับตั๋ว E-Ticket *</label>
                                <input type="email" 
                                       id="customer_email" 
                                       name="customer_email" 
                                       class="form-control" 
                                       placeholder="example@mail.com" 
                                       value="{{ Auth::user() ? Auth::user()->email : old('customer_email') }}" 
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="customer_phone">เบอร์โทรศัพท์ติดต่อ *</label>
                                <input type="tel" 
                                       id="customer_phone" 
                                       name="customer_phone" 
                                       class="form-control" 
                                       placeholder="08X-XXX-XXXX" 
                                       value="{{ Auth::user() ? Auth::user()->phone : old('customer_phone') }}" 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 0.95rem; margin-bottom: 0.75rem; color: #e2e8f0;">ช่องทางการชำระเงิน</h4>
                        
                        <div class="payment-methods">
                            <label class="payment-card selected" id="method-promptpay" onclick="selectPaymentMethod('promptpay')">
                                <input type="radio" name="payment_method" value="promptpay" checked>
                                <i data-lucide="qr-code" style="width: 28px; height: 28px; color: #06b6d4;"></i>
                                <span style="font-weight: 700; font-size: 0.95rem;">พร้อมเพย์ (PromptPay QR)</span>
                                <span style="font-size: 0.8rem; color: var(--text-dim);">สแกนจ่ายได้ทุกธนาคารทันที</span>
                            </label>

                            <label class="payment-card" id="method-card" onclick="selectPaymentMethod('credit_card')">
                                <input type="radio" name="payment_method" value="credit_card">
                                <i data-lucide="credit-card" style="width: 28px; height: 28px; color: #ec4899;"></i>
                                <span style="font-weight: 700; font-size: 0.95rem;">บัตรเครดิต / เดบิต</span>
                                <span style="font-size: 0.8rem; color: var(--text-dim);">Visa, Mastercard, JCB</span>
                            </label>
                        </div>

                        <!-- PromptPay QR Simulation Box -->
                        <div id="promptpay-box" style="background: rgba(6, 182, 212, 0.06); border: 1px solid rgba(6, 182, 212, 0.25); border-radius: var(--radius-md); padding: 1.25rem; text-align: center; margin-bottom: 1rem;">
                            <p style="font-size: 0.85rem; color: #38bdf8; margin-bottom: 0.75rem; font-weight: 600;">
                                <i data-lucide="clock" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle;"></i> 
                                QR Code มีอายุ 15:00 นาที หลังจากกดยืนยันระบบจะจำลองการชำระเงินสำเร็จทันที
                            </p>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=NEONPULSE-DEMO-PAYMENT" alt="PromptPay QR Code" style="width: 130px; height: 130px; border-radius: 8px; background: #fff; padding: 6px;">
                            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem;">
                                บัญชี: บริษัท นีออนทิกส์ เอ็นเตอร์เทนเมนท์ จำกัด
                            </p>
                        </div>

                        <!-- Credit Card Simulation Box -->
                        <div id="card-box" style="display: none; background: rgba(236, 72, 153, 0.06); border: 1px solid rgba(236, 72, 153, 0.25); border-radius: var(--radius-md); padding: 1.25rem; margin-bottom: 1rem;">
                            <div class="form-group" style="margin-bottom: 0.75rem;">
                                <label class="form-label" style="font-size: 0.8rem;">หมายเลขบัตร (จำลอง)</label>
                                <input type="text" class="form-control" placeholder="4111 2222 3333 4444" value="4111 2222 3333 4444">
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;">
                                <div>
                                    <label class="form-label" style="font-size: 0.8rem;">หมดอายุ</label>
                                    <input type="text" class="form-control" placeholder="MM/YY" value="12/28">
                                </div>
                                <div>
                                    <label class="form-label" style="font-size: 0.8rem;">CVV</label>
                                    <input type="text" class="form-control" placeholder="123" value="888">
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        <i data-lucide="check-circle" style="width: 20px; height: 20px;"></i>
                        <span>ยืนยันการชำระเงิน & ออกตั๋ว E-Ticket</span>
                    </button>
                    <p style="text-align: center; font-size: 0.8rem; color: var(--text-dim); margin-top: 0.75rem;">
                        เมื่อกดชำระเงิน ถือว่ายอมรับข้อกำหนดและเงื่อนไขการเข้างานอีเวนต์
                    </p>
                </div>
            </div>
        </form>
    </section>

    <!-- ================= VENUE & DIRECTIONS ================= -->
    <section class="section" id="venue">
        <div class="glass-panel" style="padding: 3rem 2.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem; align-items: center;">
                <div>
                    <span class="section-subtitle">LOCATION & ACCESS</span>
                    <h2 style="font-size: 2rem; margin-bottom: 1rem;">สถานที่จัดงาน & การเดินทาง</h2>
                    <p style="color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem;">
                        <strong>{{ $event->venue_name }}</strong><br>
                        {{ $event->venue_address }}
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.9rem;">
                        <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                            <div style="background: rgba(99, 102, 241, 0.2); color: #818cf8; padding: 0.4rem; border-radius: 8px;">
                                <i data-lucide="train" style="width: 18px; height: 18px;"></i>
                            </div>
                            <div>
                                <strong>รถไฟฟ้า MRT สายสีชมพู</strong>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">ลงสถานีอิมแพ็ค เมืองทองธานี (PK10) เชื่อมต่อสะพาน Skywalk เข้าสู่งาน</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                            <div style="background: rgba(236, 72, 153, 0.2); color: #f472b6; padding: 0.4rem; border-radius: 8px;">
                                <i data-lucide="car" style="width: 18px; height: 18px;"></i>
                            </div>
                            <div>
                                <strong>ที่จอดรถในร่ม 5,000 คัน</strong>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">อาคารจอดรถ P1, P2 และ P3 ค่าบริการเหมาจ่ายสำหรับผู้ถือบัตรคอนเสิร์ต</p>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.75rem; align-items: flex-start;">
                            <div style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 0.4rem; border-radius: 8px;">
                                <i data-lucide="clock" style="width: 18px; height: 18px;"></i>
                            </div>
                            <div>
                                <strong>เวลาเปิดประตูฮอลล์</strong>
                                <p style="color: var(--text-muted); font-size: 0.85rem;">เปิดให้สแกนบัตรตั้งแต่เวลา 16:30 น. การแสดงเริ่ม 17:30 น. เป็นต้นไป</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <!-- Visual Map Showcase -->
                    <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.1); position: relative; height: 320px; background: #1a2236; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 1.5rem;">
                        <i data-lucide="map" style="width: 48px; height: 48px; color: #06b6d4; margin-bottom: 1rem;"></i>
                        <h4 style="color: #fff; font-size: 1.2rem; margin-bottom: 0.5rem;">IMPACT ARENA HALL 9-10</h4>
                        <p style="color: var(--text-muted); font-size: 0.85rem; max-width: 320px; margin-bottom: 1.25rem;">
                            พิกัด GPS: 13.9115° N, 100.5488° E สะดวก รวดเร็ว มีป้ายบอกทางตลอดสาย
                        </p>
                        <a href="https://maps.google.com/?q=Impact+Arena+Muang+Thong+Thani" target="_blank" rel="noopener noreferrer" class="btn btn-outline-cyan btn-sm">
                            <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
                            <span>เปิดบน Google Maps</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= FAQ SECTION ================= -->
    <section class="section" id="faq">
        <div class="section-header">
            <span class="section-subtitle">HAVE QUESTIONS?</span>
            <h2 class="section-title">คำถามที่พบบ่อย (FAQ)</h2>
            <p style="color: var(--text-muted); margin-top: 0.75rem;">
                ข้อมูลสำคัญเกี่ยวกับการเข้างาน การนำสิ่งของเข้าพื้นที่ และการตรวจสอบตั๋ว E-Ticket
            </p>
        </div>

        <div class="faq-list">
            <div class="faq-item active">
                <button type="button" class="faq-question" onclick="toggleFaq(this)">
                    <span>วิธีการเข้างานและแสดงตั๋ว E-Ticket ทำอย่างไร?</span>
                    <i data-lucide="chevron-down" style="width: 18px; height: 18px;"></i>
                </button>
                <div class="faq-answer">
                    เมื่อจองสำเร็จ คุณจะได้รับตั๋ว E-Ticket พร้อม QR Code ทันที สามารถเปิดแสดงผ่านหน้าจอมือถือ หรือปรินต์ใส่กระดาษเพื่อให้เจ้าหน้าที่หน้าประตูด้านหน้าสแกนเข้างานได้สะดวก
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" onclick="toggleFaq(this)">
                    <span>งานนี้จำกัดอายุผู้เข้าชมหรือไม่?</span>
                    <i data-lucide="chevron-down" style="width: 18px; height: 18px;"></i>
                </button>
                <div class="faq-answer">
                    ผู้เข้าชมต้องมีอายุ 18 ปีบริบูรณ์ขึ้นไปในวันจัดงาน กรุณานำบัตรประชาชนตัวจริง หรือพาสปอร์ต หรือใบขับขี่มาแสดงคู่กับตั๋วที่จุดลงทะเบียน
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" onclick="toggleFaq(this)">
                    <span>สามารถโอนสิทธิ์ตั๋วหรือซื้อให้เพื่อนได้หรือไม่?</span>
                    <i data-lucide="chevron-down" style="width: 18px; height: 18px;"></i>
                </button>
                <div class="faq-answer">
                    สามารถซื้อให้เพื่อนหรือครอบครัวได้ โดยในการจองระบบจะออกรหัส E-Ticket แยกใบต่อท่าน สามารถส่งลิงก์หรือรูปภาพ QR Code ให้เพื่อนนำไปสแกนเข้างานได้เลย
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question" onclick="toggleFaq(this)">
                    <span>สิ่งของต้องห้ามภายในงานมีอะไรบ้าง?</span>
                    <i data-lucide="chevron-down" style="width: 18px; height: 18px;"></i>
                </button>
                <div class="faq-answer">
                    ไม่อนุญาตให้นำอาวุธ ของมีคม สารเสพติด เครื่องดื่มแอลกอฮอล์จากภายนอก กล้องถ่ายภาพระดับโปร (DSLR/Mirrorless เลนส์แยก) และไม้เซลฟี่เข้ามาในพื้นที่จัดงาน
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    // 1. Countdown Clock Logic
    const eventDate = new Date("{{ $event->event_date->toIso8601String() }}").getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = eventDate - now;

        if (distance < 0) {
            document.getElementById('days').innerText = '00';
            document.getElementById('hours').innerText = '00';
            document.getElementById('minutes').innerText = '00';
            document.getElementById('seconds').innerText = '00';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('days').innerText = String(days).padStart(2, '0');
        document.getElementById('hours').innerText = String(hours).padStart(2, '0');
        document.getElementById('minutes').innerText = String(minutes).padStart(2, '0');
        document.getElementById('seconds').innerText = String(seconds).padStart(2, '0');
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();

    // 2. Quantity Management & Subtotal Calculation
    function updateQty(ticketId, change) {
        const input = document.getElementById(`qty-input-${ticketId}`);
        if (!input) return;

        let current = parseInt(input.value) || 0;
        let max = parseInt(input.getAttribute('max')) || 5;
        let min = parseInt(input.getAttribute('min')) || 0;

        let next = current + change;
        if (next >= min && next <= max) {
            input.value = next;
            calculateTotal();
        }
    }

    function calculateTotal() {
        const counters = document.querySelectorAll('.ticket-qty-counter');
        let totalCount = 0;
        let totalPrice = 0;
        let summaryText = [];
        let modalItemsHtml = '';

        counters.forEach(counter => {
            const qty = parseInt(counter.value) || 0;
            const price = parseFloat(counter.getAttribute('data-price')) || 0;
            const name = counter.getAttribute('data-name');

            if (qty > 0) {
                totalCount += qty;
                const lineTotal = qty * price;
                totalPrice += lineTotal;
                summaryText.push(`${name} (${qty} ใบ)`);

                modalItemsHtml += `
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>${name} &times; ${qty}</span>
                        <span style="font-weight: 700;">฿${lineTotal.toLocaleString()}</span>
                    </div>
                `;
            }
        });

        // Update elements
        document.getElementById('total-qty-count').innerText = totalCount;
        document.getElementById('total-price-amount').innerText = totalPrice.toLocaleString();
        document.getElementById('modal-total-price').innerText = totalPrice.toLocaleString();
        document.getElementById('selected-tickets-preview').innerText = summaryText.join(' • ');
        document.getElementById('modal-order-items').innerHTML = modalItemsHtml;

        // Toggle Floating Bar
        const bar = document.getElementById('booking-bar');
        if (totalCount > 0) {
            bar.classList.add('active');
        } else {
            bar.classList.remove('active');
        }
    }

    function resetSelection() {
        const counters = document.querySelectorAll('.ticket-qty-counter');
        counters.forEach(c => c.value = 0);
        calculateTotal();
    }

    // 3. Modal Controls
    function openCheckoutModal() {
        const totalCount = parseInt(document.getElementById('total-qty-count').innerText) || 0;
        if (totalCount <= 0) {
            alert('กรุณาเลือกจำนวนบัตรที่ต้องการอย่างน้อย 1 ใบ');
            return;
        }
        document.getElementById('checkout-modal').classList.add('open');
    }

    function closeCheckoutModal() {
        document.getElementById('checkout-modal').classList.remove('open');
    }

    // Payment method selector
    function selectPaymentMethod(method) {
        document.getElementById('method-promptpay').classList.remove('selected');
        document.getElementById('method-card').classList.remove('selected');

        const promptpayBox = document.getElementById('promptpay-box');
        const cardBox = document.getElementById('card-box');

        if (method === 'promptpay') {
            document.getElementById('method-promptpay').classList.add('selected');
            document.getElementById('method-promptpay').querySelector('input').checked = true;
            promptpayBox.style.display = 'block';
            cardBox.style.display = 'none';
        } else {
            document.getElementById('method-card').classList.add('selected');
            document.getElementById('method-card').querySelector('input').checked = true;
            promptpayBox.style.display = 'none';
            cardBox.style.display = 'block';
        }
    }

    // 4. FAQ Accordion
    function toggleFaq(button) {
        const item = button.parentElement;
        item.classList.toggle('active');
    }
</script>
@endsection

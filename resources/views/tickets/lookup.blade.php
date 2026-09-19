@extends('layouts.app')

@section('title', 'ค้นหาตั๋ว E-Ticket - NEONTIX')

@section('content')
<div class="container" style="padding-top: 4rem; padding-bottom: 5rem;">
    <div style="max-width: 480px; margin: 0 auto;">
        <div class="glass-panel" style="padding: 2.5rem 2rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="logo-badge" style="width: 48px; height: 48px; margin: 0 auto 1rem;">
                    <i data-lucide="search" style="width: 24px; height: 24px; color: #fff;"></i>
                </div>
                <h2 style="font-size: 1.8rem; margin-bottom: 0.35rem;">ค้นหาตั๋ว E-Ticket</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    กรอกรหัสการจอง (เช่น TK-XXXXXXXX) เพื่อเรียกดูตั๋วหรือพิมพ์บัตรเข้างาน
                </p>
            </div>

            <form action="{{ route('tickets.lookup.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="booking_code">รหัสการจอง (Booking Code)</label>
                    <input type="text" 
                           id="booking_code" 
                           name="booking_code" 
                           value="{{ old('booking_code') }}" 
                           class="form-control" 
                           placeholder="เช่น TK-ABC12345" 
                           style="text-transform: uppercase; font-family: monospace; letter-spacing: 1px;"
                           required 
                           autofocus>
                    @error('booking_code')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 1rem; margin-top: 0.5rem;">
                    <i data-lucide="search" style="width: 18px; height: 18px;"></i>
                    <span>ค้นหาและเปิดตั๋ว</span>
                </button>
            </form>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-glass); text-align: center;">
                <p style="font-size: 0.85rem; color: var(--text-dim);">
                    หากจำรหัสการจองไม่ได้ หรือต้องการดูประวัติตั๋วทั้งหมด
                </p>
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" style="margin-top: 0.75rem;">
                    <i data-lucide="user" style="width: 14px; height: 14px;"></i>
                    <span>เข้าสู่ระบบด้วยอีเมล</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

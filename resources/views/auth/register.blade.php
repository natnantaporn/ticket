@extends('layouts.app')

@section('title', 'สมัครสมาชิก - AURAPASS')

@section('content')
<div class="container" style="padding-top: 3.5rem; padding-bottom: 5rem;">
    <div style="max-width: 500px; margin: 0 auto;">
        <div class="glass-panel" style="padding: 2.75rem 2.25rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="logo-badge" style="width: 50px; height: 50px; margin: 0 auto 1.25rem;">
                    <i data-lucide="user-plus" style="width: 22px; height: 22px; color: var(--champagne);"></i>
                </div>
                <h2 style="font-size: 1.85rem; margin-bottom: 0.35rem; letter-spacing: -0.02em;">สมัครสมาชิกใหม่</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    สร้างบัญชีเพื่อจองตั๋วคอนเสิร์ตและรับสิทธิพิเศษก่อนใคร
                </p>
            </div>

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">ชื่อ - นามสกุล *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           class="form-control" 
                           placeholder="เช่น สมศักดิ์ มุ่งมั่น" 
                           required 
                           autofocus>
                    @error('name')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">อีเมล *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           class="form-control" 
                           placeholder="example@mail.com" 
                           required>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="phone">เบอร์โทรศัพท์ติดต่อ *</label>
                    <input type="tel" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           class="form-control" 
                           placeholder="08X-XXX-XXXX" 
                           required>
                    @error('phone')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label class="form-label" for="password">รหัสผ่าน *</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-control" 
                               placeholder="อย่างน้อย 6 ตัว" 
                               required>
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">ยืนยันรหัสผ่าน *</label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-control" 
                               placeholder="พิมพ์อีกครั้ง" 
                               required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 1rem; margin-top: 0.75rem;">
                    <i data-lucide="check" style="width: 18px; height: 18px;"></i>
                    <span>สร้างบัญชีและเริ่มต้นใช้งาน</span>
                </button>
            </form>

            <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-muted); border-top: 1px solid var(--border-glass); padding-top: 1.25rem;">
                มีบัญชีอยู่แล้ว? 
                <a href="{{ route('login') }}" style="color: #38bdf8; font-weight: 600;">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'เข้าสู่ระบบ - AURAPASS')

@section('content')
<div class="container" style="padding-top: 4rem; padding-bottom: 5rem;">
    <div style="max-width: 460px; margin: 0 auto;">
        <div class="glass-panel" style="padding: 2.75rem 2.25rem;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <div class="logo-badge" style="width: 50px; height: 50px; margin: 0 auto 1.25rem;">
                    <i data-lucide="lock" style="width: 22px; height: 22px; color: var(--champagne);"></i>
                </div>
                <h2 style="font-size: 1.85rem; margin-bottom: 0.35rem; letter-spacing: -0.02em;">เข้าสู่ระบบสมาชิก</h2>
                <p style="color: var(--text-muted); font-size: 0.9rem;">
                    เข้าสู่ระบบเพื่อจัดการตั๋ว และดูประวัติการจองของคุณ
                </p>
            </div>

            <!-- Quick Demo Login Hint -->
            <div style="background: rgba(226, 192, 121, 0.08); border: 1px solid rgba(226, 192, 121, 0.25); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1.75rem; font-size: 0.85rem;">
                <p style="font-weight: 700; color: var(--champagne-light); margin-bottom: 0.5rem;">
                    <i data-lucide="sparkles" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle;"></i>
                    บัญชีทดสอบด่วน (คลิกเพื่อกรอกอัตโนมัติ):
                </p>
                <div style="display: flex; gap: 0.5rem;">
                    <button type="button" class="btn btn-secondary btn-sm" style="flex: 1; font-size: 0.78rem; padding: 0.3rem 0.5rem;" onclick="fillLogin('user@ticket.test', 'password123')">
                        ผู้ใช้ทั่วไป (Demo)
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" style="flex: 1; font-size: 0.78rem; padding: 0.3rem 0.5rem;" onclick="fillLogin('admin@ticket.test', 'password123')">
                        แอดมิน (Admin)
                    </button>
                </div>
            </div>

            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">อีเมล</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           class="form-control" 
                           placeholder="example@mail.com" 
                           required 
                           autofocus>
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">รหัสผ่าน</label>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="••••••••" 
                           required>
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; font-size: 0.85rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: var(--text-muted);">
                        <input type="checkbox" name="remember" value="1">
                        <span>จดจำการเข้าสู่ระบบ</span>
                    </label>
                    <a href="{{ route('tickets.lookup') }}" style="color: #38bdf8;">ลืมรหัส / ค้นหาตั๋ว</a>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.85rem; font-size: 1rem;">
                    <i data-lucide="log-in" style="width: 18px; height: 18px;"></i>
                    <span>เข้าสู่ระบบ</span>
                </button>
            </form>

            <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: var(--text-muted); border-top: 1px solid var(--border-glass); padding-top: 1.25rem;">
                ยังไม่มีบัญชีใช่หรือไม่? 
                <a href="{{ route('register') }}" style="color: #f472b6; font-weight: 600;">สมัครสมาชิกฟรี</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function fillLogin(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
@endsection

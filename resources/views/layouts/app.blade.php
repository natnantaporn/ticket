<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NEON PULSE 2026 - ระบบจองตั๋วคอนเสิร์ตและอีเวนต์สุดล้ำ')</title>
    <meta name="description" content="สัมผัสประสบการณ์เทศกาลดนตรีระดับเวิลด์คลาส จองตั๋วออนไลน์ง่ายๆ พร้อม E-Ticket ทันที">
    
    <!-- Google Fonts & Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <!-- Ambient Background Lighting -->
    <div class="ambient-bg">
        <div class="ambient-blob-1"></div>
        <div class="ambient-blob-2"></div>
        <div class="ambient-blob-3"></div>
    </div>

    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="brand-logo">
                <div class="logo-badge">
                    <i data-lucide="sparkles" style="width: 20px; height: 20px; color: var(--champagne);"></i>
                </div>
                <span>AURA<span class="text-gradient-gold">PASS</span></span>
            </a>

            <nav>
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}#about" class="nav-link">เกี่ยวกับงาน</a></li>
                    <li><a href="{{ route('home') }}#highlights" class="nav-link">ไฮไลต์</a></li>
                    <li><a href="{{ route('home') }}#tickets" class="nav-link">โซนบัตร & ราคา</a></li>
                    <li><a href="{{ route('home') }}#venue" class="nav-link">สถานที่จัดงาน</a></li>
                    <li><a href="{{ route('home') }}#faq" class="nav-link">คำถามพบบ่อย</a></li>
                </ul>
            </nav>

            <div class="nav-actions">
                <a href="{{ route('tickets.lookup') }}" class="btn btn-secondary btn-sm" title="ค้นหาตั๋วด้วยรหัสการจอง">
                    <i data-lucide="search" style="width: 16px; height: 16px;"></i>
                    <span>ค้นหาตั๋ว</span>
                </a>

                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-cyan btn-sm">
                            <i data-lucide="shield" style="width: 16px; height: 16px;"></i>
                            <span>ระบบแอดมิน</span>
                        </a>
                    @endif

                    <a href="{{ route('tickets.my') }}" class="btn btn-secondary btn-sm">
                        <i data-lucide="ticket" style="width: 16px; height: 16px;"></i>
                        <span>ตั๋วของฉัน</span>
                    </a>

                    <div class="user-badge">
                        <i data-lucide="user" style="width: 16px; height: 16px; color: #38bdf8;"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm" title="ออกจากระบบ" style="padding: 0.45rem 0.75rem;">
                            <i data-lucide="log-out" style="width: 16px; height: 16px;"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                        <i data-lucide="log-in" style="width: 16px; height: 16px;"></i>
                        <span>เข้าสู่ระบบ</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                        <span>สมัครสมาชิก</span>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="alert-toast alert-success" id="flash-toast">
            <i data-lucide="check-circle-2" style="width: 22px; height: 22px; flex-shrink: 0;"></i>
            <div>
                <strong>สำเร็จ!</strong>
                <p style="margin: 0; font-size: 0.9rem;">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-toast alert-error" id="flash-toast">
            <i data-lucide="alert-circle" style="width: 22px; height: 22px; flex-shrink: 0;"></i>
            <div>
                <strong>แจ้งเตือน:</strong>
                <p style="margin: 0; font-size: 0.9rem;">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="alert-toast alert-info" id="flash-toast">
            <i data-lucide="info" style="width: 22px; height: 22px; flex-shrink: 0;"></i>
            <div>
                <p style="margin: 0; font-size: 0.9rem;">{{ session('info') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="brand-logo" style="margin-bottom: 1rem;">
                        <div class="logo-badge">
                            <i data-lucide="sparkles" style="width: 20px; height: 20px; color: var(--champagne);"></i>
                        </div>
                        <span>AURA<span class="text-gradient-gold">PASS</span></span>
                    </div>
                    <p style="max-width: 380px; margin-bottom: 1.5rem; color: var(--text-muted); font-size: 0.88rem; line-height: 1.7;">
                        แพลตฟอร์มจำหน่ายบัตรระดับพรีเมียม ประสบการณ์ Liquid Glass UI ระบบออกตั๋ว E-Ticket แบบ Instant Cryptographic Pass
                    </p>
                    <div style="display: flex; gap: 1rem; color: var(--text-muted);">
                        <span style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem;">
                            <i data-lucide="shield-check" style="width: 14px; height: 14px; color: var(--champagne);"></i> 256-bit Encrypted
                        </span>
                        <span style="display: flex; align-items: center; gap: 0.4rem; font-size: 0.85rem;">
                            <i data-lucide="gem" style="width: 14px; height: 14px; color: #38bdf8;"></i> Luxury Verified
                        </span>
                    </div>
                </div>

                <div>
                    <h4 style="font-size: 1rem; margin-bottom: 1.2rem; color: #fff;">เมนูลัด</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.6rem;">
                        <li><a href="{{ route('home') }}#about" style="color: var(--text-muted);">รายละเอียดงาน</a></li>
                        <li><a href="{{ route('home') }}#tickets" style="color: var(--text-muted);">จองตั๋วงานอีเวนต์</a></li>
                        <li><a href="{{ route('tickets.lookup') }}" style="color: var(--text-muted);">ค้นหาและพิมพ์ตั๋ว</a></li>
                        <li><a href="{{ route('login') }}" style="color: var(--text-muted);">เข้าสู่ระบบสมาชิก</a></li>
                    </ul>
                </div>

                <div>
                    <h4 style="font-size: 1rem; margin-bottom: 1.2rem; color: #fff;">ฝ่ายบริการลูกค้า</h4>
                    <p style="margin-bottom: 0.5rem; color: var(--text-muted);">
                        <i data-lucide="mail" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle;"></i> support@neontix.test
                    </p>
                    <p style="margin-bottom: 0.5rem; color: var(--text-muted);">
                        <i data-lucide="phone" style="width: 14px; height: 14px; display: inline-block; vertical-align: middle;"></i> 02-999-8888 (10:00 - 20:00 น.)
                    </p>
                    <p style="color: var(--text-dim); font-size: 0.8rem; margin-top: 1rem;">
                        &copy; {{ date('Y') }} NEONTIX Entertainment Co., Ltd. สงวนลิขสิทธิ์
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons & Flash Timer -->
    <script>
        lucide.createIcons();

        // Auto dismiss flash message
        const flashToast = document.getElementById('flash-toast');
        if (flashToast) {
            setTimeout(() => {
                flashToast.style.opacity = '0';
                flashToast.style.transform = 'translateX(100%)';
                setTimeout(() => flashToast.remove(), 400);
            }, 5000);
        }
    </script>
    @yield('scripts')
</body>
</html>

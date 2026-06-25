<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lourdes Academy Attendance System</title>
    <meta name="description" content="Fast, accurate attendance tracking with QR codes and instant parent communication for Lourdes Academy.">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --navy: #0d2b5e;
            --navy-2: #153b7a;
            --navy-dark: #0a1f44;
            --gold: #c9a227;
            --gold-light: #e7c75a;
            --gray-bg: #f6f8fb;
            --gray-100: #f1f5f9;
        }
        
        * {
            -webkit-font-smoothing: antialiased;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #1e293b;
            background: #ffffff;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        
        h1, h2, h3, h4 { color: var(--navy); letter-spacing: -0.02em; }
        
        .text-navy { color: var(--navy) !important; }
        .text-gold { color: var(--gold) !important; }
        .bg-navy { background: var(--navy) !important; }
        .bg-gray { background: var(--gray-bg) !important; }
        
        /* Navbar */
        .navbar {
            background: rgba(255,255,255,0.9);
            backdrop-filter: saturate(180%) blur(10px);
            border-bottom: 1px solid #eef2f7;
            padding: 0.9rem 0;
            transition: all 0.3s;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--navy) !important;
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo-mark {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--navy), var(--navy-2));
            border-radius: 10px;
            display: grid;
            place-items: center;
            color: var(--gold-light);
            box-shadow: 0 4px 12px rgba(13,43,94,0.2), inset 0 1px 0 rgba(255,255,255,0.1);
            position: relative;
        }
        .logo-mark::after {
            content: '';
            position: absolute;
            inset: 3px;
            border: 1.5px solid rgba(201,162,39,0.4);
            border-radius: 7px;
        }
        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            padding: 0.5rem 1rem !important;
            font-size: 0.95rem;
            position: relative;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--navy) !important;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: all 0.3s;
            transform: translateX(-50%);
        }
        .nav-link:hover::after { width: 60%; }
        
        .btn-gold {
            background: var(--gold);
            color: var(--navy-dark);
            font-weight: 600;
            border: none;
            padding: 0.6rem 1.3rem;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(201,162,39,0.25);
            transition: all 0.2s;
        }
        .btn-gold:hover {
            background: #b8931f;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(201,162,39,0.35);
        }
        .btn-outline-navy {
            border: 1.5px solid var(--navy);
            color: var(--navy);
            font-weight: 600;
            padding: 0.6rem 1.3rem;
            border-radius: 12px;
            background: transparent;
        }
        .btn-outline-navy:hover {
            background: var(--navy);
            color: white;
            transform: translateY(-1px);
        }
        
        /* Hero */
        .hero {
            padding: 100px 0 80px;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 60%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -200px;
            right: -200px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(201,162,39,0.08), transparent 70%);
            border-radius: 50%;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(13,43,94,0.06);
            border: 1px solid rgba(13,43,94,0.1);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--navy);
            margin-bottom: 20px;
        }
        .hero-title {
            font-size: clamp(2.2rem, 5vw, 3.4rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 20px;
        }
        .hero-title span { color: var(--gold); }
        .hero-lead {
            font-size: 1.1rem;
            color: #475569;
            max-width: 520px;
            margin-bottom: 32px;
            line-height: 1.6;
        }
        
        /* Phone Mockup */
        .phone-mockup {
            max-width: 300px;
            margin: 0 auto;
            position: relative;
        }
        .phone-frame {
            background: #0b1a33;
            border-radius: 2.8rem;
            padding: 12px;
            box-shadow: 
                0 30px 60px rgba(13,43,94,0.25),
                0 0 0 1px rgba(255,255,255,0.05) inset,
                0 1px 0 rgba(255,255,255,0.1) inset;
        }
        .phone-screen {
            background: #0f2350;
            border-radius: 2.2rem;
            aspect-ratio: 9/19.5;
            overflow: hidden;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .phone-notch {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            height: 24px;
            background: #0b1a33;
            border-radius: 0 0 14px 14px;
            z-index: 10;
        }
        .scan-area {
            width: 72%;
            aspect-ratio: 1;
            border: 2px solid rgba(255,255,255,.12);
            border-radius: 1.2rem;
            position: relative;
            overflow: hidden;
            background: radial-gradient(circle at center, rgba(201,162,39,0.18), transparent 60%);
        }
        .qr-target {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            color: #e7c75a;
            font-size: 4.5rem;
            opacity: .95;
        }
        .scan-line {
            position: absolute;
            left: 10%;
            right: 10%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #e7c75a, transparent);
            top: 15%;
            animation: scanMove 2.4s ease-in-out infinite;
            box-shadow: 0 0 18px #c9a227;
            border-radius: 2px;
        }
        @keyframes scanMove {
            0%, 100% { top: 15%; }
            50% { top: 82%; }
        }
        .student-id-card {
            position: absolute;
            bottom: 22px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            border-radius: 14px;
            padding: 10px 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,.25);
            text-align: center;
            width: 78%;
        }
        .student-id-card small {
            display: block;
            font-size: .65rem;
            color: #64748b;
            letter-spacing: .08em;
            text-transform: uppercase;
            font-weight: 600;
        }
        .student-id-card strong {
            color: var(--navy);
            font-size: .92rem;
            font-weight: 600;
        }
        
        /* Section */
        .section {
            padding: 80px 0;
        }
        .section-header {
            max-width: 680px;
            margin: 0 auto 50px;
            text-align: center;
        }
        .section-eyebrow {
            color: var(--gold);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.82rem;
            letter-spacing: 0.08em;
            margin-bottom: 10px;
        }
        .section-title {
            font-size: clamp(1.8rem, 3.5vw, 2.4rem);
            font-weight: 700;
            margin-bottom: 14px;
        }
        .section-desc {
            color: #64748b;
            font-size: 1.05rem;
        }
        
        /* Scanner Card */
        .scanner-card {
            background: var(--navy-dark);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 50px rgba(13,43,94,.28);
            border: 1px solid rgba(255,255,255,0.08);
        }
        .scanner-viewport {
            aspect-ratio: 16/10;
            background: linear-gradient(180deg,#0a1f44 0%, #0d2b5e 100%);
            position: relative;
            display: grid;
            place-items: center;
            overflow: hidden;
        }
        .camera-grid {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px);
            background-size: 44px 44px;
            opacity: .25;
        }
        .scanner-frame {
            width: 220px;
            height: 220px;
            position: relative;
            z-index: 2;
        }
        .corner {
            position: absolute;
            width: 36px;
            height: 36px;
            border: 3.5px solid var(--gold);
        }
        .corner.tl { top: 0; left: 0; border-right: none; border-bottom: none; border-radius: 14px 0 0 0; }
        .corner.tr { top: 0; right: 0; border-left: none; border-bottom: none; border-radius: 0 14px 0 0; }
        .corner.bl { bottom: 0; left: 0; border-right: none; border-top: none; border-radius: 0 0 0 14px; }
        .corner.br { bottom: 0; right: 0; border-left: none; border-top: none; border-radius: 0 0 14px 0; }
        .scanner-laser {
            position: absolute;
            left: 12%;
            width: 76%;
            height: 2px;
            background: var(--gold-light);
            top: 20%;
            box-shadow: 0 0 20px #c9a227, 0 0 40px #c9a227;
            opacity: 0;
            transition: opacity .3s;
            border-radius: 2px;
        }
        .scanning .scanner-laser {
            opacity: 1;
            animation: laser 1.8s ease-in-out infinite;
        }
        @keyframes laser {
            0%, 100% { top: 18%; }
            50% { top: 82%; }
        }
        .scanner-ui {
            position: absolute;
            bottom: 20px;
            left: 0; right: 0;
            text-align: center;
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            z-index: 2;
        }
        .scanner-footer {
            background: rgba(0,0,0,0.2);
            backdrop-filter: blur(10px);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        
        /* Features */
        .feature-card {
            border: 1px solid #e6eaf2;
            border-radius: 22px;
            padding: 28px;
            height: 100%;
            background: white;
            transition: all .35s cubic-bezier(0.2, 0.8, 0.2, 1);
            box-shadow: 0 4px 14px rgba(13,43,94,.04);
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--navy), var(--gold));
            transform: scaleX(0);
            transition: transform 0.35s;
            transform-origin: left;
        }
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(13,43,94,.12);
            border-color: rgba(201,162,39,.35);
        }
        .feature-card:hover::before { transform: scaleX(1); }
        .icon-bubble {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, var(--navy), var(--navy-2));
            color: var(--gold-light);
            font-size: 1.6rem;
            margin-bottom: 18px;
            box-shadow: 0 8px 20px rgba(13,43,94,.18), inset 0 1px 0 rgba(255,255,255,0.1);
        }
        .feature-card h5 {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--navy);
        }
        .feature-card p {
            color: #5a6b85;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }
        
        /* How it works */
        .how-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
            max-width: 960px;
            margin: 0 auto;
            position: relative;
        }
        @media (min-width: 768px) {
            .how-grid { grid-template-columns: repeat(3, 1fr); gap: 0; }
        }
        .step {
            text-align: center;
            position: relative;
            padding: 0 24px;
        }
        .step-number {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--navy);
            color: white;
            display: grid;
            place-items: center;
            margin: 0 auto 18px;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 0 0 8px rgba(201,162,39,.15), 0 8px 20px rgba(13,43,94,0.2);
            position: relative;
            z-index: 2;
        }
        .step-icon {
            font-size: 1.8rem;
            color: var(--gold);
            margin-bottom: 12px;
        }
        .step h5 { font-weight: 600; margin-bottom: 8px; }
        .step p { color: #64748b; font-size: 0.95rem; }
        .step-connector {
            display: none;
        }
        @media (min-width: 768px) {
            .step-connector {
                display: block;
                position: absolute;
                top: 32px;
                left: calc(50% + 40px);
                width: calc(100% - 80px);
                height: 2px;
                background: repeating-linear-gradient(90deg, #cbd5e1 0 8px, transparent 8px 16px);
                z-index: 1;
            }
        }
        
        /* Email mockup */
        .email-card {
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 24px 50px rgba(13,43,94,.1);
            overflow: hidden;
            background: white;
            max-width: 520px;
            margin: 0 auto;
        }
        .email-header {
            background: #f8fafc;
            padding: 14px 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .dot { width: 11px; height: 11px; border-radius: 50%; }
        .dot.red { background: #ef4444; }
        .dot.yellow { background: #f59e0b; }
        .dot.green { background: #22c55e; }
        .email-toolbar {
            margin-left: auto;
            display: flex;
            gap: 8px;
            color: #94a3b8;
            font-size: 0.9rem;
        }
        .email-body { padding: 28px; }
        .email-meta {
            font-size: .85rem;
            color: #64748b;
            margin-bottom: 18px;
            line-height: 1.7;
        }
        .email-meta strong { color: #334155; }
        .badge-status {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .email-content {
            background: #f8fafc;
            border: 1px solid #eef2f7;
            border-radius: 14px;
            padding: 20px;
            margin-top: 16px;
        }
        
        /* Stats */
        .stats-bar {
            background: var(--navy);
            color: white;
            position: relative;
            overflow: hidden;
            padding: 60px 0;
        }
        .stats-bar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(600px 200px at 15% -20%, rgba(201,162,39,.22), transparent),
                radial-gradient(500px 180px at 85% 120%, rgba(201,162,39,.18), transparent);
        }
        .stat-item { text-align: center; position: relative; z-index: 2; }
        .stat-value {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            color: var(--gold-light);
            line-height: 1;
            margin-bottom: 8px;
        }
        .stat-label {
            color: #cbd5e1;
            font-size: .98rem;
            font-weight: 500;
        }
        
        /* Reveal animation */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Footer */
        footer {
            background: var(--navy-dark);
            color: #cbd5e1;
            padding-top: 60px;
        }
        footer a {
            color: #cbd5e1;
            text-decoration: none;
            opacity: 0.85;
            transition: all 0.2s;
        }
        footer a:hover { opacity: 1; color: white; }
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 20px 0;
            margin-top: 40px;
            font-size: 0.88rem;
            color: #94a3b8;
        }
        
        /* Mobile */
        @media (max-width: 390px) {
            .hero { padding: 80px 0 60px; }
            .phone-mockup { max-width: 260px; }
            .section { padding: 60px 0; }
            .scanner-footer { flex-direction: column; align-items: stretch; }
            .btn-gold, .btn-outline-navy { width: 100%; }
        }
        
        /* Toast */
        .toast { border-radius: 14px; box-shadow: 0 12px 30px rgba(0,0,0,0.15); }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <div class=""><img 
                    src="https://scontent.fdvo1-2.fna.fbcdn.net/v/t39.30808-6/272546157_107796111815001_1700017094958757330_n.png?stp=dst-png&cstp=mx849x798&ctp=s849x798&_nc_cat=103&ccb=1-7&_nc_sid=6ee11a&_nc_eui2=AeEZQGL3opeY_c3rzK5Y26e2Vx699BXQAydXHr30FdADJ5RlKFZuFFIPanSU_i14TPOvBFLDl7G-uIK6UW_VxcQv&_nc_ohc=OKsQ6krq2jMQ7kNvwEtvVI-&_nc_oc=AdpQx0wW8Fg2yzLwzb0SYz3-hvruSKuQ3-hp8cLbLrflSRBzSGHxW1wixXK8imLMoeyxQzFrOgBS0coKCgZpLRM_&_nc_zt=23&_nc_ht=scontent.fdvo1-2.fna&_nc_gid=wRbGUT4lRZ4MdLekQhnbWg&_nc_ss=7b2a8&oh=00_Af_bE42wJEOkvRdfGINWmsMhI6xa9rORE_c46gX1-cdaaw&oe=6A425A4D"
                    alt="Logo"
                    width="40"
                    height="40"
                    class="rounded-circle border border-2 border-primary">
                </div>
                <span>Lourdes Academy</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#parents">For Parents</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex gap-2 mt-3 mt-lg-0">
                    <a href="login.php" class="btn btn-gold"><i class="bi bi-person-lock me-1"></i>Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero" id="home">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-badge">
                        <i class="bi bi-patch-check-fill text-gold"></i>
                        Official Attendance Platform 2025-2026
                    </div>
                    <h1 class="hero-title">Lourdes Academy <span>Attendance</span> System</h1>
                    <p class="hero-lead">Fast, accurate attendance tracking with QR codes and instant parent communication. Reduce manual work, improve safety, and keep families informed in real-time.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#scanner" class="btn btn-gold btn-lg" id="heroScanBtn">
                            <i class="bi bi-qr-code-scan me-2"></i>Scan Attendance
                        </a>
                        <a href="#features" class="btn btn-outline-navy btn-lg">
                            <i class="bi bi-play-circle me-2"></i>View Demo
                        </a>
                    </div>
                    <!-- <div class="d-flex align-items-center gap-4 mt-4 pt-2">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-check text-success fs-5"></i>
                            <small class="text-muted">FERPA Compliant</small>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-lightning-charge-fill text-gold fs-5"></i>
                            <small class="text-muted">&lt; 2 sec scan</small>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-6">
                    <div class="phone-mockup reveal">
                        <div class="phone-frame">
                            <div class="phone-screen">
                                <div class="phone-notch"></div>
                                <div class="scan-area">
                                    <div class="qr-target"><i class="bi bi-qr-code"></i></div>
                                    <div class="scan-line"></div>
                                </div>
                                <div class="student-id-card">
                                    <small>Student ID</small>
                                    <strong>Santos, Maria L. — Grade 8 St. Joseph</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scanner Highlight -->
    <section class="section bg-gray" id="scanner">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-eyebrow">Live Demo</div>
                <h2 class="section-title">QR Scanner in Action</h2>
                <p class="section-desc">Point the camera at a student ID. Attendance is recorded instantly and securely.</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="scanner-card reveal">
                        <div class="scanner-viewport">
                            <div class="camera-grid"></div>
                            <div class="scanner-frame">
                                <div class="corner tl"></div>
                                <div class="corner tr"></div>
                                <div class="corner bl"></div>
                                <div class="corner br"></div>
                                <div class="scanner-laser"></div>
                            </div>
                            <div class="scanner-ui">Align QR code within frame</div>
                        </div>
                        <div class="scanner-footer">
                            <div>
                                <div class="text-white fw-semibold mb-1">Ready to Scan</div>
                                <div id="scanStatus" class="small" style="color: rgba(255,255,255,0.7);">
                                    <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>Camera ready</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-gold" id="startScanBtn">
                                    <i class="bi bi-qr-code-scan me-1"></i> Start Demo Scan
                                </button>
                                <button class="btn btn-outline-light" style="border-color: rgba(255,255,255,0.3);">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="text-center text-muted small mt-3"><i class="bi bi-info-circle me-1"></i>Demo only — no camera access required. In production, this connects to your device camera.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="section" id="features">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-eyebrow">Features</div>
                <h2 class="section-title">Built for Accuracy, Speed, and Trust</h2>
                <p class="section-desc">Everything Lourdes Academy needs to modernize daily attendance.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card reveal">
                        <div class="icon-bubble"><i class="bi bi-qr-code-scan"></i></div>
                        <h5>QR Code Scanning</h5>
                        <p>Fast and accurate. Each student ID has a unique QR. Scan in under 2 seconds, even in low light.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card reveal" style="transition-delay: 0.1s">
                        <div class="icon-bubble"><i class="bi bi-envelope-check"></i></div>
                        <h5>Automatic Email Notifications</h5>
                        <p>Parents notified instantly for absences or tardiness. Customizable templates and timing.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card reveal" style="transition-delay: 0.2s">
                        <div class="icon-bubble"><i class="bi bi-speedometer2"></i></div>
                        <h5>Real-time Monitoring Dashboard</h5>
                        <p>Live attendance view for teachers and admins. Filter by grade, section, or status.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card reveal" style="transition-delay: 0.3s">
                        <div class="icon-bubble"><i class="bi bi-shield-lock"></i></div>
                        <h5>Secure & Efficient Records</h5>
                        <p>Encrypted data, role-based access, and automated daily reports. No more paper logs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section bg-gray" id="how">
        <div class="container">
            <div class="section-header reveal">
                <div class="section-eyebrow">How It Works</div>
                <h2 class="section-title">Scan → Record → Notify</h2>
                <p class="section-desc">Three simple steps that take seconds, not minutes.</p>
            </div>
            
            <div class="how-grid">
                <div class="step reveal">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="bi bi-upc-scan"></i></div>
                    <h5>Scan Student ID</h5>
                    <p>Teacher opens scanner on tablet or phone and scans the QR code on the student ID.</p>
                    <div class="step-connector"></div>
                </div>
                <div class="step reveal" style="transition-delay: 0.15s">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="bi bi-database-check"></i></div>
                    <h5>Record Instantly</h5>
                    <p>System logs time, date, and status (Present, Late, Absent) to the secure cloud database.</p>
                    <div class="step-connector"></div>
                </div>
                <div class="step reveal" style="transition-delay: 0.3s">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="bi bi-bell"></i></div>
                    <h5>Notify Parents</h5>
                    <p>If late or absent, an automated email is sent to parents within 60 seconds with details.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- For Parents / Email -->
    <section class="section" id="parents">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="reveal">
                        <div class="section-eyebrow">For Parents</div>
                        <h2 class="section-title">Instant, Clear Communication</h2>
                        <p class="section-desc mb-4">No more waiting for calls. You'll receive an immediate email if your child is marked absent or late, with time stamp and teacher notes.</p>
                        
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex gap-3">
                                <div class="text-gold fs-4"><i class="bi bi-check2-circle"></i></div>
                                <div>
                                    <h6 class="mb-1 text-navy">Timely Alerts</h6>
                                    <p class="mb-0 text-muted small">Delivered in under 60 seconds after scanning.</p>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="text-gold fs-4"><i class="bi bi-check2-circle"></i></div>
                                <div>
                                    <h6 class="mb-1 text-navy">Complete Transparency</h6>
                                    <p class="mb-0 text-muted small">View daily, weekly, and monthly attendance history in parent portal.</p>
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div class="text-gold fs-4"><i class="bi bi-check2-circle"></i></div>
                                <div>
                                    <h6 class="mb-1 text-navy">Secure & Private</h6>
                                    <p class="mb-0 text-muted small">Only authorized guardians receive notifications.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="email-card reveal">
                        <div class="email-header">
                            <div class="dot red"></div>
                            <div class="dot yellow"></div>
                            <div class="dot green"></div>
                            <span class="ms-2 small fw-medium" style="color: #475569;">Mail</span>
                            <div class="email-toolbar">
                                <i class="bi bi-reply"></i>
                                <i class="bi bi-trash"></i>
                            </div>
                        </div>
                        <div class="email-body">
                            <div class="email-meta">
                                <div><strong>From:</strong> Lourdes Academy Attendance &lt;attendance@lourdesacademy.edu.ph&gt;</div>
                                <div><strong>To:</strong> parent.santos@email.com</div>
                                <div><strong>Subject:</strong> Attendance Alert: Maria Santos - Late Arrival</div>
                                <div><strong>Date:</strong> Oct 15, 2026 at 7:42 AM</div>
                            </div>
                            <span class="badge-status"><i class="bi bi-clock-history"></i> Late Arrival</span>
                            
                            <div class="email-content">
                                <p class="mb-2"><strong>Dear Mr. & Mrs. Santos,</strong></p>
                                <p class="mb-2" style="font-size: 0.95rem; color: #334155;">This is to inform you that <strong>Maria Santos (Grade 8 - St. Joseph)</strong> has been marked <strong>LATE</strong> today.</p>
                                <p class="mb-0" style="font-size: 0.95rem; color: #334155;"><strong>Time In:</strong> 7:42 AM (Classes start at 7:30 AM)<br>
                                <strong>Recorded by:</strong> Ms. Reyes, Gate 1</p>
                            </div>
                            <p class="small text-muted mt-3 mb-0">You are receiving this because you are listed as a primary guardian. Reply to this email to contact the class adviser.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="stats-bar">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Faster check-in vs manual</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-value">Zero</div>
                        <div class="stat-label">Manual encoding errors</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-value">&lt;60s</div>
                        <div class="stat-label">Parents notified</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="logo-mark"><i class="bi bi-shield-fill"></i></div>
                        <span class="fs-5 fw-semibold text-white">Lourdes Academy</span>
                    </div>
                    <p class="small" style="max-width: 380px; opacity: 0.8;">"Were Peace-making is life giving" <BR>
-Pagadian Diocesan School.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="text-white mb-3">System</h6>
                    <ul class="list-unstyled small d-grid gap-2">
                        <li><a href="#features">Features</a></li>
                        <li><a href="#how">How It Works</a></li>
                        <li><a href="#">Teacher Login</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="text-white mb-3">Support</h6>
                    <ul class="list-unstyled small d-grid gap-2">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="text-white mb-3">Contact</h6>
                    <ul class="list-unstyled small d-grid gap-2" style="opacity: 0.85;">
                        <li><i class="bi bi-geo-alt me-2 text-gold"></i> Lourdes Academy, Poblacion San Miguel, ZDS</li>
                        <li><i class="bi bi-envelope me-2 text-gold"></i> lourdesacademy101@gmail.com</li>
                        <li><i class="bi bi-telephone me-2 text-gold"></i> 09502915715</li>
                    </ul>
                </div>
            <div class="footer-bottom d-flex flex-wrap justify-content-between gap-2">
                <div>© 2026 Lourdes Academy. All rights reserved.</div>
                <!-- <div>Attendance System v2.1.0 • Secure • FERPA Compliant</div> -->
            </div>
        </div>
    </footer>

    <!-- Success Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>
                        <strong>Present</strong> — <span id="toastName">Maria Santos - Grade 8</span>
                        <div class="small opacity-75">Recorded at <span id="toastTime">7:42 AM</span></div>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll for nav links
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const id = a.getAttribute('href');
                if(id.length > 1) {
                    e.preventDefault();
                    document.querySelector(id)?.scrollIntoView({behavior: 'smooth', block: 'start'});
                    // Close mobile nav
                    const nav = document.getElementById('nav');
                    if(nav.classList.contains('show')) {
                        new bootstrap.Collapse(nav).hide();
                    }
                }
            });
        });

        // Reveal on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Scanner demo
        const startBtn = document.getElementById('startScanBtn');
        const viewport = document.querySelector('.scanner-viewport');
        const scanStatus = document.getElementById('scanStatus');
        const toastEl = document.getElementById('successToast');
        const toast = new bootstrap.Toast(toastEl);
        const students = [
            'Dsie Jayne Perocho - Grade 10 St. Peter'
        ];
        let scanning = false;

        function runScan() {
            if(scanning) return;
            scanning = true;
            viewport.classList.add('scanning');
            scanStatus.innerHTML = '<span class="text-warning"><i class="bi bi-camera-video me-1"></i>Scanning...</span>';
            startBtn.disabled = true;
            startBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Scanning';
            
            setTimeout(() => {
                viewport.classList.remove('scanning');
                scanStatus.innerHTML = '<span class="text-success"><i class="bi bi-check-circle-fill me-1"></i>Ready to scan</span>';
                startBtn.disabled = false;
                startBtn.innerHTML = '<i class="bi bi-qr-code-scan me-1"></i> Start Demo Scan';
                scanning = false;
                
                // Update toast
                document.getElementById('toastName').textContent = students[Math.floor(Math.random() * students.length)];
                document.getElementById('toastTime').textContent = new Date().toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});
                toast.show();
            }, 2400);
        }

        startBtn.addEventListener('click', runScan);
        
        document.getElementById('heroScanBtn').addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelector('#scanner').scrollIntoView({behavior: 'smooth'});
            setTimeout(runScan, 700);
        });

        // Active nav on scroll
        const sections = document.querySelectorAll('section[id]');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(sec => {
                const top = window.scrollY + 120;
                if(top >= sec.offsetTop) current = sec.id;
            });
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.toggle('active', link.getAttribute('href') === '#' + current);
            });
        });
    </script>
<script>(function(){document.addEventListener("click",function(e){var a=e.target.closest("[data-product-id]");if(!a)return;e.preventDefault();var pid=a.getAttribute("data-product-id");if(pid)parent.postMessage({type:"ecto-artifact-link-click",productId:pid},"*")})})();</script>
</body>
</html>
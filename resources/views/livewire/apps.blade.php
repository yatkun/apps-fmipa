@push('styles')
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .app-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
        }

        .app-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("https://cdn.siap.id/s3/UI-UX/doc-project-dxs/img/bg-ppg1.png");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.1;
            z-index: -1;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 2rem;
            font-weight: 300;
        }

        .apps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .app-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .app-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .app-card:hover::before {
            transform: scaleX(1);
        }

        .app-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 1);
        }

        .app-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .app-card:hover .app-icon {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .app-icon img {
            width: 50px;
            height: 50px;
            filter: brightness(0) invert(1);
        }

        .app-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.75rem;
        }

        .app-description {
            color: #718096;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .app-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .app-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .app-button:hover::before {
            left: 100%;
        }

        .app-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .app-button:active {
            transform: translateY(0);
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #48bb78;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-badge.coming-soon {
            background: #ed8936;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-circle:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .apps-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .app-card {
                padding: 2rem;
            }
        }

        /* Loading animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 0.5rem;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Fade in animation */
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
        }

        .fade-in-delay-1 {
            animation-delay: 0.2s;
        }

        .fade-in-delay-2 {
            animation-delay: 0.4s;
        }

        .fade-in-delay-3 {
            animation-delay: 0.6s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Pulse animation for active status */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(72, 187, 120, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(72, 187, 120, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(72, 187, 120, 0);
            }
        }
    </style>
@endpush

<div class="app-container">
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <div class="container-fluid">
        <!-- Hero Section -->
        <!-- Apps Grid -->
        <div class="apps-grid">
            <!-- Aplikasi IKU -->
            <div class="app-card fade-in fade-in-delay-1">
                <div class="status-badge pulse">Aktif</div>
                <div class="app-icon">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="IKU Logo">
                </div>
                <h3 class="app-title">Aplikasi IKU</h3>
                <p class="app-description">
                    Sistem penginputan dan monitoring kinerja fakultas berdasarkan Indikator Kinerja Utama (IKU) yang telah ditetapkan.
                </p>
                <button wire:click="choose('IKU')" 
                        wire:loading.attr="disabled"
                        wire:target="choose('IKU')"
                        class="app-button">
                    <span wire:loading.remove wire:target="choose('IKU')">
                        Masuk ke IKU
                    </span>
                    <span wire:loading wire:target="choose('IKU')">
                        <span class="loading-spinner"></span>
                        Memuat...
                    </span>
                </button>
            </div>

            <!-- Aplikasi E-Dokumen -->
            {{-- <div class="app-card fade-in fade-in-delay-2">
                <div class="status-badge pulse">Aktif</div>
                <div class="app-icon">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="E-Dokumen Logo">
                </div>
                <h3 class="app-title">Aplikasi E-Dokumen</h3>
                <p class="app-description">
                    Platform digital untuk pengelolaan, penyimpanan, dan administrasi dokumen FMIPA secara terintegrasi dan paperless.
                </p>
                <button wire:click="choose('EDokumen')" 
                        wire:loading.attr="disabled"
                        wire:target="choose('EDokumen')"
                        class="app-button">
                    <span wire:loading.remove wire:target="choose('EDokumen')">
                        Masuk ke E-Dokumen
                    </span>
                    <span wire:loading wire:target="choose('EDokumen')">
                        <span class="loading-spinner"></span>
                        Memuat...
                    </span>
                </button>
            </div> --}}

            <!-- Aplikasi E-Dokumen -->
            <div class="app-card fade-in fade-in-delay-2">
                <div class="status-badge coming-soon">Segera Hadir</div>
                <div class="app-icon">
                    <img src="{{ asset('assets/images/logo.svg') }}" alt="E-Dokumen Logo">
                </div>
                <h3 class="app-title">Aplikasi E-Dokumen</h3>
                <p class="app-description">
                    Platform digital untuk pengelolaan, penyimpanan, dan administrasi dokumen FMIPA secara terintegrasi dan paperless.
                </p>
                <button disabled class="app-button" style="opacity: 0.6; cursor: not-allowed;">
                    Segera Hadir
                </button>
            </div>

           
        </div>
    </div>
</div>

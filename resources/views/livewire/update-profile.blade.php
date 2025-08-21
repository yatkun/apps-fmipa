@section('title', 'Update Profile')
@push('styles')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .profile-page {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .main-profile-card {
            border-radius: 6px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            background: white;
            transition: all 0.3s ease;
        }

        .main-profile-card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-2px);
        }

        .profile-section {
            position: relative;
            margin-top: 2rem;
            z-index: 10;
            padding: 0 2rem;
        }

        .profile-avatar-container {
            position: relative;
            display: inline-block;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border: 4px solid white;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }

        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            opacity: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .profile-avatar-container:hover .avatar-overlay {
            opacity: 1;
        }

        .avatar-upload-icon {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.3rem;
        }

        .profile-info-section {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .form-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .form-group-modern {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-label-modern {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control-modern {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
            outline: none;
        }

        .form-control-modern:hover {
            border-color: #cbd5e0;
            background: white;
        }

        .form-control-modern:disabled {
            background: #f7fafc;
            color: #a0aec0;
            cursor: not-allowed;
            border-color: #e2e8f0;
        }

        .form-control-modern:disabled:hover {
            background: #f7fafc;
            border-color: #e2e8f0;
        }

        .input-icon {
            font-size: 1.1rem;
        }

        .btn-modern {
            border-radius: 8px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 0.9rem;
        }

        .btn-primary-modern {
            background: var(--primary-gradient);
            color: white !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary-modern {
            background: #f7fafc;
            color: #4a5568;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary-modern:hover {
            background: #edf2f7;
            border-color: #cbd5e0;
            transform: translateY(-1px);
        }

        .alert-modern {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success-modern {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
        }

        .alert-danger-modern {
            background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
            color: white;
        }

        .telegram-help-card {
            background: linear-gradient(135deg, #0088cc 0%, #0077bb 100%);
            color: white;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 0.5rem;
        }

        .telegram-help-card .step {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
        }

        .telegram-help-card .step:last-child {
            margin-bottom: 0;
        }

        .step-number {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .page-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-title {
            color: #2d3748;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #718096;
            font-size: 1rem;
        }

        .profile-stats {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            flex: 1;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-value {
            font-weight: 600;
            font-size: 1rem;
            color: #2d3748;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #718096;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .profile-page {
                padding: 1rem 0;
            }
            
            .profile-section {
                padding: 0 1rem;
            }
            
            .profile-avatar {
                width: 120px;
                height: 120px;
            }
            
            .cover-photo {
                height: 120px;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .profile-avatar {
                width: 100px;
                height: 100px;
            }
        }
    </style>
@endpush


<div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page Header -->
               

                <div class="row justify-content-center">
                    <!-- Main Profile Card -->
                    <div class="col-lg-12">
                        <div class="main-profile-card">
                            <!-- Profile Info Section -->
                            <div class="profile-section">
                                <div class="row justify-content-center align-items-center">
                                    <!-- Profile Picture Column -->
                                    <div class="col-auto">
                                        <div class="profile-avatar-container">
                                            @if (!empty($user->profile_picture))
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" 
                                                     class="profile-avatar">
                                            @else
                                                <img src="{{ asset('storage/profile_pictures/avatar.png') }}" alt="Avatar" 
                                                     class="profile-avatar">
                                            @endif
                                            <div class="avatar-overlay">
                                                <i class="fas fa-camera avatar-upload-icon"></i>
                                                <small class="text-white fw-bold" style="font-size: 0.75rem;">GANTI FOTO</small>
                                            </div>
                                            <input type="file" wire:model="profile_picture" id="profile-image-upload" 
                                                   class="d-none" accept="image/*">
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>

                            <!-- Form Section -->
                            <div class="form-section">
                                <div class="mb-3 text-center">
                                    <h5 style="color: #2d3748; font-weight: 600;">
                                        <i class="fas fa-edit me-2" style="color: #667eea;"></i>
                                        Informasi Personal
                                    </h5>
                                    <p class="mb-0 text-muted" style="font-size: 0.9rem;">Lengkapi data diri Anda untuk pengalaman yang lebih baik</p>
                                </div>

                                <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Nama Lengkap -->
                                        <div class="col-lg-6">
                                            <div class="form-group-modern">
                                                <label for="name" class="form-label-modern">
                                                    <i class="fas fa-user input-icon" style="color: #667eea;"></i>
                                                    Nama Lengkap
                                                </label>
                                                <input type="text" class="form-control form-control-modern" id="name" 
                                                       wire:model.defer="name" placeholder="Masukkan nama lengkap Anda">
                                                @error('name') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-lg-6">
                                            <div class="form-group-modern">
                                                <label for="email" class="form-label-modern">
                                                    <i class="fas fa-envelope input-icon" style="color: #667eea;"></i>
                                                    Alamat Email
                                                </label>
                                                <input type="email" class="form-control form-control-modern" id="email" 
                                                       wire:model.defer="email" placeholder="contoh@email.com">
                                                @error('email') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="col-lg-6">
                                            <div class="form-group-modern">
                                                <label for="username" class="form-label-modern">
                                                    <i class="fas fa-user-shield input-icon" style="color: #667eea;"></i>
                                                    Username
                                                </label>
                                                <input type="text" class="form-control form-control-modern" id="username" 
                                                       wire:model.defer="username" placeholder="username / nidn" disabled>
                                                @error('username') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Telegram Chat ID -->
                                        <div class="col-lg-6">
                                            <div class="form-group-modern">
                                                <label for="telegram_chat_id" class="form-label-modern">
                                                    <i class="fab fa-telegram input-icon" style="color: #0088cc;"></i>
                                                    Telegram Chat ID
                                                </label>
                                                <input type="text" class="form-control form-control-modern" id="telegram_chat_id" 
                                                       wire:model.defer="telegram_chat_id" placeholder="123456789">
                                                
                                                <!-- Telegram Help Card -->
                                                <div class="telegram-help-card">
                                                    <div class="mb-2 d-flex align-items-center">
                                                        <i class="fab fa-telegram me-2" style="font-size: 1.2rem;"></i>
                                                        <strong style="font-size: 0.9rem;">Cara mendapatkan Chat ID:</strong>
                                                    </div>
                                                    <div class="step">
                                                        <span class="step-number">1</span>
                                                        <span>Buka bot @fmipausb_bot di Telegram</span>
                                                    </div>
                                                    <div class="step">
                                                        <span class="step-number">2</span>
                                                        <span>Kirim pesan "/start" atau "/mychatid"</span>
                                                    </div>
                                                    <div class="step">
                                                        <span class="step-number">3</span>
                                                        <span>Bot akan membalas dengan Chat ID Anda</span>
                                                    </div>
                                                    <div class="step">
                                                        <span class="step-number">4</span>
                                                        <span>Copy dan paste Chat ID ke field ini</span>
                                                    </div>
                                                </div>
                                                
                                                @error('telegram_chat_id') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Password Section -->
                                    <div class="mt-4 mb-3">
                                        <h6 style="color: #2d3748; font-weight: 600; border-bottom: 2px solid #f7fafc; padding-bottom: 0.5rem;">
                                            <i class="fas fa-lock me-2" style="color: #667eea;"></i>
                                            Ubah Password (Opsional)
                                        </h6>
                                        <p class="mb-0 text-muted" style="font-size: 0.85rem;">Kosongkan jika tidak ingin mengubah password</p>
                                    </div>

                                    <div class="row">
                                        <!-- Current Password -->
                                        <div class="col-lg-4">
                                            <div class="form-group-modern">
                                                <label for="current_password" class="form-label-modern">
                                                    <i class="fas fa-key input-icon" style="color: #667eea;"></i>
                                                    Password Saat Ini
                                                </label>
                                                <input type="password" class="form-control form-control-modern" id="current_password" 
                                                       wire:model.defer="current_password" placeholder="Masukkan password saat ini">
                                                @error('current_password') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- New Password -->
                                        <div class="col-lg-4">
                                            <div class="form-group-modern">
                                                <label for="new_password" class="form-label-modern">
                                                    <i class="fas fa-shield-alt input-icon" style="color: #667eea;"></i>
                                                    Password Baru
                                                </label>
                                                <input type="password" class="form-control form-control-modern" id="new_password" 
                                                       wire:model.defer="new_password" placeholder="Masukkan password baru (min. 8 karakter)">
                                                @error('new_password') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Confirm New Password -->
                                        <div class="col-lg-4">
                                            <div class="form-group-modern">
                                                <label for="new_password_confirmation" class="form-label-modern">
                                                    <i class="fas fa-check-circle input-icon" style="color: #667eea;"></i>
                                                    Konfirmasi Password Baru
                                                </label>
                                                <input type="password" class="form-control form-control-modern" id="new_password_confirmation" 
                                                       wire:model.defer="new_password_confirmation" placeholder="Ulangi password baru">
                                                @error('new_password_confirmation') 
                                                    <div class="mt-2 text-danger">
                                                        <small class="d-flex align-items-center">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="gap-3 pt-3 mt-4 d-flex justify-content-center" style="border-top: 2px solid #f7fafc;">
                                        
                                        <button type="submit" class="btn btn-primary-modern btn-modern">
                                            <i class="fas fa-save me-2"></i>
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile image upload functionality
            const profileImageContainer = document.querySelector('.profile-avatar-container');
            const profileImageUpload = document.getElementById('profile-image-upload');
            
            if (profileImageContainer && profileImageUpload) {
                profileImageContainer.addEventListener('click', function() {
                    profileImageUpload.click();
                });

                // Add loading state for profile image
                profileImageUpload.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = profileImageContainer.querySelector('.profile-avatar');
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // Telegram Chat ID validation
            const telegramInput = document.getElementById('telegram_chat_id');
            if (telegramInput) {
                telegramInput.addEventListener('input', function() {
                    // Only allow numbers
                    this.value = this.value.replace(/\D/g, '');
                    
                    // Visual feedback for valid Chat ID format
                    if (this.value.length >= 8) {
                        this.style.borderColor = '#0088cc';
                        this.style.backgroundColor = 'rgba(0, 136, 204, 0.05)';
                    } else {
                        this.style.borderColor = '#e2e8f0';
                        this.style.backgroundColor = '#f8fafc';
                    }
                });
            }

            // Password validation and visual feedback
            const currentPasswordInput = document.getElementById('current_password');
            const newPasswordInput = document.getElementById('new_password');
            const confirmPasswordInput = document.getElementById('new_password_confirmation');

            // Password strength indicator
            if (newPasswordInput) {
                newPasswordInput.addEventListener('input', function() {
                    const password = this.value;
                    const strength = calculatePasswordStrength(password);
                    
                    // Remove existing strength indicator
                    const existingIndicator = this.parentNode.querySelector('.password-strength');
                    if (existingIndicator) {
                        existingIndicator.remove();
                    }
                    
                    // Add strength indicator if password is not empty
                    if (password.length > 0) {
                        const strengthIndicator = document.createElement('div');
                        strengthIndicator.className = 'password-strength mt-1';
                        strengthIndicator.innerHTML = `
                            <div class="d-flex align-items-center">
                                <div class="strength-bar me-2" style="flex: 1; height: 4px; background: #e2e8f0; border-radius: 2px;">
                                    <div style="height: 100%; background: ${strength.color}; width: ${strength.percentage}%; border-radius: 2px; transition: all 0.3s ease;"></div>
                                </div>
                                <small style="color: ${strength.color}; font-size: 0.75rem;">${strength.text}</small>
                            </div>
                        `;
                        this.parentNode.appendChild(strengthIndicator);
                    }
                });
            }

            // Password confirmation validation
            if (confirmPasswordInput) {
                confirmPasswordInput.addEventListener('input', function() {
                    const password = newPasswordInput.value;
                    const confirmation = this.value;
                    
                    if (confirmation.length > 0) {
                        if (password === confirmation) {
                            this.style.borderColor = '#48bb78';
                            this.style.backgroundColor = 'rgba(72, 187, 120, 0.05)';
                        } else {
                            this.style.borderColor = '#f56565';
                            this.style.backgroundColor = 'rgba(245, 101, 101, 0.05)';
                        }
                    } else {
                        this.style.borderColor = '#e2e8f0';
                        this.style.backgroundColor = '#f8fafc';
                    }
                });
            }

            // Function to calculate password strength
            function calculatePasswordStrength(password) {
                let score = 0;
                if (password.length >= 8) score += 1;
                if (/[a-z]/.test(password)) score += 1;
                if (/[A-Z]/.test(password)) score += 1;
                if (/[0-9]/.test(password)) score += 1;
                if (/[^A-Za-z0-9]/.test(password)) score += 1;
                
                switch (score) {
                    case 0:
                    case 1:
                        return { percentage: 20, color: '#f56565', text: 'Sangat Lemah' };
                    case 2:
                        return { percentage: 40, color: '#ed8936', text: 'Lemah' };
                    case 3:
                        return { percentage: 60, color: '#ecc94b', text: 'Sedang' };
                    case 4:
                        return { percentage: 80, color: '#68d391', text: 'Kuat' };
                    case 5:
                        return { percentage: 100, color: '#48bb78', text: 'Sangat Kuat' };
                    default:
                        return { percentage: 0, color: '#e2e8f0', text: '' };
                }
            }

            // Form validation feedback
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const btnIcon = submitBtn.querySelector('i');
                    const btnText = submitBtn.childNodes[2];
                    
                    // Add loading state
                    submitBtn.disabled = true;
                    btnIcon.className = 'fas fa-spinner fa-spin me-2';
                    btnText.textContent = 'Menyimpan...';
                    
                    // Reset after 3 seconds (in case of client-side issues)
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        btnIcon.className = 'fas fa-save me-2';
                        btnText.textContent = 'Simpan Perubahan';
                    }, 3000);
                });
            }

            // Add smooth scrolling to form errors
            const errorElements = document.querySelectorAll('.text-danger');
            if (errorElements.length > 0) {
                const firstError = errorElements[0];
                const errorField = firstError.closest('.form-group-modern');
                if (errorField) {
                    errorField.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                    
                    // Add shake animation to error field
                    errorField.style.animation = 'shake 0.5s ease-in-out';
                    setTimeout(() => {
                        errorField.style.animation = '';
                    }, 500);
                }
            }

            // Add input focus animations
            const inputs = document.querySelectorAll('.form-control-modern');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.closest('.form-group-modern').style.transform = 'translateY(-2px)';
                    this.closest('.form-group-modern').style.transition = 'transform 0.2s ease';
                });

                input.addEventListener('blur', function() {
                    this.closest('.form-group-modern').style.transform = 'translateY(0px)';
                });
            });
        });

        // Add shake animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);
    </script>
@endpush

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telegram Bot Test - FMIPA USB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fab fa-telegram me-2"></i>
                            Telegram Bot Test Interface
                        </h4>
                        <p class="mb-0 opacity-75">Test notifikasi bot @fmipausb_bot</p>
                    </div>
                </div>

                <!-- Connection Test -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-plug me-2"></i>
                            Test Koneksi Bot
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Test koneksi dasar ke Telegram Bot API</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-success" onclick="testConnection()">
                                <i class="fas fa-check-circle me-1"></i>
                                Test Connection
                            </button>
                            <button class="btn btn-info" onclick="sendDailySummary()">
                                <i class="fas fa-chart-bar me-1"></i>
                                Send Daily Summary
                            </button>
                        </div>
                        <div id="connectionResult" class="mt-3"></div>
                    </div>
                </div>

                <!-- Letter Notifications Test -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>
                            Test Notifikasi Surat
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Test notifikasi untuk surat yang ada di sistem</p>
                        
                        @if($letters->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Judul Surat</th>
                                            <th>Pengaju</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($letters as $letter)
                                            <tr>
                                                <td>
                                                    <div class="fw-medium">{{ $letter->title }}</div>
                                                    @if($letter->template)
                                                        <small class="text-muted">{{ $letter->template->name }}</small>
                                                    @else
                                                        <small class="text-muted">Surat Custom</small>
                                                    @endif
                                                </td>
                                                <td>{{ $letter->creator->name ?? 'Unknown' }}</td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'verification_tendik' => 'warning',
                                                            'verification_dekan' => 'info',
                                                            'approved' => 'success',
                                                            'rejected' => 'danger'
                                                        ];
                                                        $statusLabels = [
                                                            'verification_tendik' => 'Verifikasi Tendik',
                                                            'verification_dekan' => 'Verifikasi Dekan',
                                                            'approved' => 'Disetujui',
                                                            'rejected' => 'Ditolak'
                                                        ];
                                                    @endphp
                                                    <span class="badge bg-{{ $statusColors[$letter->status] ?? 'secondary' }}">
                                                        {{ $statusLabels[$letter->status] ?? $letter->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $letter->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary" 
                                                            onclick="testLetterNotification('{{ $letter->hashed_id }}')">
                                                        <i class="fas fa-paper-plane me-1"></i>
                                                        Test Notif
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada surat untuk di-test</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Bot Info -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-robot me-2"></i>
                            Informasi Bot
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Bot Username:</h6>
                                <p class="text-muted">{{ env('TELEGRAM_BOT_USERNAME', '@fmipausb_bot') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Chat ID:</h6>
                                <p class="text-muted">{{ env('TELEGRAM_CHAT_ID', '1943944168') }}</p>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Bot akan mengirim notifikasi otomatis saat:
                            <ul class="mb-0 mt-2">
                                <li>Surat baru diajukan</li>
                                <li>Surat diverifikasi oleh Tendik</li>
                                <li>Surat disetujui/ditolak oleh Dekan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="notificationToast" class="toast" role="alert">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Setup CSRF token for AJAX requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        function showResult(elementId, success, message) {
            const element = document.getElementById(elementId);
            const alertClass = success ? 'alert-success' : 'alert-danger';
            const icon = success ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
            
            element.innerHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show">
                    <i class="${icon} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
        }
        
        function showToast(message, success = true) {
            const toast = document.getElementById('notificationToast');
            const toastBody = toast.querySelector('.toast-body');
            const toastHeader = toast.querySelector('.toast-header strong');
            
            toastHeader.textContent = success ? 'Success' : 'Error';
            toastBody.innerHTML = `<i class="${success ? 'fas fa-check-circle text-success' : 'fas fa-exclamation-circle text-danger'} me-2"></i>${message}`;
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }
        
        async function testConnection() {
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Testing...';
            button.disabled = true;
            
            try {
                const response = await fetch('/telegram/test-connection', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                showResult('connectionResult', data.success, data.message);
                showToast(data.message, data.success);
            } catch (error) {
                showResult('connectionResult', false, 'Network error: ' + error.message);
                showToast('Network error occurred', false);
            } finally {
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }
        
        async function sendDailySummary() {
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Sending...';
            button.disabled = true;
            
            try {
                const response = await fetch('/telegram/daily-summary', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                showResult('connectionResult', data.success, data.message);
                showToast(data.message, data.success);
            } catch (error) {
                showResult('connectionResult', false, 'Network error: ' + error.message);
                showToast('Network error occurred', false);
            } finally {
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }
        
        async function testLetterNotification(letterId) {
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Sending...';
            button.disabled = true;
            
            try {
                const response = await fetch(`/telegram/test-letter/${letterId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                showToast(data.message, data.success);
            } catch (error) {
                showToast('Network error occurred', false);
            } finally {
                button.innerHTML = originalText;
                button.disabled = false;
            }
        }
    </script>
</body>
</html>

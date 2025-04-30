@extends('admin.admin_master')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom bg-primary text-white">
        <h2 class="mb-0">Change Password</h2>
        <p class="text-muted mb-0">Update your account password securely</p>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}" class="form-pill needs-validation" novalidate>
            @csrf
            
            <!-- Current Password Field -->
            <div class="form-group mb-4">
                <label for="current_password" class="form-label">
                    Current Password 
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group has-validation">
                    <input type="password" 
                           name="oldpassword" 
                           class="form-control rounded-end-0" 
                           id="current_password"
                           placeholder="Enter current password"
                           required
                           autocomplete="current-password">
                    <button type="button" 
                            class="input-group-text toggle-password bg-white border-start-0" 
                            aria-label="Toggle password visibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('oldpassword')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password Field -->
            <div class="form-group mb-4">
                <label for="password" class="form-label">
                    New Password 
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group has-validation">
                    <input type="password" 
                           name="password" 
                           class="form-control rounded-end-0" 
                           id="password" 
                           placeholder="At least 8 characters"
                           required
                           minlength="8"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$"
                           autocomplete="new-password">
                    <button type="button" 
                            class="input-group-text toggle-password bg-white border-start-0" 
                            aria-label="Toggle password visibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-text">
                    Must contain: uppercase, lowercase, number
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <div class="password-strength mt-2">
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar" role="progressbar"></div>
                    </div>
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group mb-4">
                <label for="password_confirmation" class="form-label">
                    Confirm Password 
                    <span class="text-danger">*</span>
                </label>
                <div class="input-group has-validation">
                    <input type="password" 
                           name="password_confirmation" 
                           class="form-control rounded-end-0" 
                           id="password_confirmation" 
                           placeholder="Re-enter new password"
                           required
                           autocomplete="new-password">
                    <button type="button" 
                            class="input-group-text toggle-password bg-white border-start-0" 
                            aria-label="Toggle password visibility">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div id="password-match-feedback" class="form-text"></div>
                @error('password_confirmation')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Update Password
                </button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript Enhancements -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Password visibility toggle
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.closest('.input-group').querySelector('input');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
        });
    });

    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const progressBar = document.querySelector('.progress-bar');
    
    if(passwordInput && progressBar) {
        passwordInput.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            progressBar.style.width = strength.percentage + '%';
            progressBar.className = 'progress-bar ' + strength.class;
        });
    }

    // Password match verification
    const confirmPassword = document.getElementById('password_confirmation');
    if(confirmPassword) {
        confirmPassword.addEventListener('input', function() {
            const feedback = document.getElementById('password-match-feedback');
            if(this.value && this.value !== passwordInput.value) {
                feedback.textContent = 'Passwords do not match';
                feedback.style.color = 'var(--bs-danger)';
            } else if(this.value) {
                feedback.textContent = 'Passwords match';
                feedback.style.color = 'var(--bs-success)';
            } else {
                feedback.textContent = '';
            }
        });
    }

    function calculatePasswordStrength(password) {
        let strength = 0;
        // Length contributes up to 50%
        strength += Math.min(50, (password.length / 12) * 50);
        
        // Character variety contributes up to 50%
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /\d/.test(password);
        const hasSpecial = /[^A-Za-z0-9]/.test(password);
        
        const varietyCount = [hasUpper, hasLower, hasNumber, hasSpecial].filter(Boolean).length;
        strength += (varietyCount / 4) * 50;
        
        // Normalize to 100%
        strength = Math.min(100, strength);
        
        return {
            percentage: strength,
            class: strength < 40 ? 'bg-danger' : 
                   strength < 70 ? 'bg-warning' : 'bg-success'
        };
    }
});
</script>

<style>
.toggle-password {
    cursor: pointer;
    transition: all 0.2s;
}
.toggle-password:hover {
    background-color: #f8f9fa !important;
}
.password-strength .progress {
    background-color: #e9ecef;
}
</style>
@endsection

@extends('admin.admin_master')

@section('admin')
<div class="card card-default">
    <div class="card-header card-header-border-bottom bg-primary text-white">
        <h2 class="mb-0">User Profile Update</h2>
        <p class="text-muted mb-0">Update your Profile</p>
    </div>
    

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


    <div class="card-body">
        <form method="POST" action="{{ route('update.user.profile') }}" class="form-pill needs-validation" novalidate>
            @csrf
            
            <!-- Current Password Field -->
            <div class="form-group mb-4">
                <label for="current_password" class="form-label">
                    User Name 
                    <input type="text" 
                        name="name" 
                        class="form-control rounded-end-0"   value="{{ $user->name }}">

        </div>

            <div class="form-group mb-4">
                <label for="current_password" class="form-label">
                    User Email 
                    <input type="text" 
                        name="email" 
                        class="form-control rounded-end-0"            value="{{ $user->email }}">

        </div>
        <button type="submit" class="btn btn-primary btn-default"> Update </button>

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

  
@endsection

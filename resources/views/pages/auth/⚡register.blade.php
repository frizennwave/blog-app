<?php

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Auth\Events\Registered;

new class extends Component
{
    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255|unique:users,username')]
    public $username = '';

    #[Validate('required|string|email|max:255|unique:users,email')]
    public $email = '';

    #[Validate('required|string|min:8|confirmed')]
    public $password = '';

    public $password_confirmation = '';

    public function register()
    {
        $this->validate();

        $user = User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $user->profile()->create([
            'name' => $this->name,
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }

    public function render()
    {
        return $this->view()->layout('layouts::app')->title('Register');
    }
};
?>

<div class="container pt-custom min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4 p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Create Account</h3>
                        <p class="text-muted small">Silakan daftar untuk membuat akun Laravel baru</p>
                    </div>

                    <!-- Form Register -->
                    <form wire:submit="register">
                        <!-- Input Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label text-secondary small fw-semibold">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-user text-muted"></i></span>
                                <input type="text" class="form-control bg-light border-start-0 @error('name') is-invalid @enderror" id="name" wire:model="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label text-secondary small fw-semibold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-at text-muted"></i></span>
                                <input type="text" class="form-control bg-light border-start-0 @error('username') is-invalid @enderror" id="username" wire:model="username" value="{{ old('username') }}" placeholder="username" required>
                            </div>
                            @error('username')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-secondary small fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                                <input type="email" class="form-control bg-light border-start-0 @error('email') is-invalid @enderror" id="email" wire:model="email" value="{{ old('email') }}" placeholder="nama@example.com" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label text-secondary small fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                                <input type="password" class="form-control bg-light border-start-0 @error('password') is-invalid @enderror" id="password" wire:model="password" placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label text-secondary small fw-semibold">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                                <input type="password" class="form-control bg-light border-start-0" id="password_confirmation" wire:model="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-3">
                                <span wire:loading.remove>Sign Up</span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Mendaftar...
                                </span>
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-semibold">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


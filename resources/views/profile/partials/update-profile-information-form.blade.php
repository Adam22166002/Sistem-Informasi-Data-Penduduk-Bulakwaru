<section>
    <header class="mb-4">
        <h2 class="h5 fw-bold text-dark">Profile Information</h2>
        <p class="text-muted small mb-0">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Verifikasi Email --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small mb-1">
                        Your email address is unverified.
                        <button 
                            form="send-verification" 
                            class="btn btn-link btn-sm p-0 align-baseline text-decoration-none">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small mb-0">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p class="bg-success text-white p-2 small mb-0" style="border-radius: 6px;" id="profile-updated-msg">Profile updated successfully.</p>
                <script>
                    setTimeout(() => {
                        document.getElementById('profile-updated-msg')?.remove();
                    }, 5000);
                </script>
            @endif
        </div>
    </form>
</section>

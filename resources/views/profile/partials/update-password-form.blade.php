<section>
    <header class="mb-4">
        <h2 class="h5 fw-bold text-dark">Update Password</h2>
        <p class="text-muted small mb-0">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                id="update_password_current_password"
                name="current_password"
                autocomplete="current-password"
                required>
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                id="update_password_password"
                name="password"
                autocomplete="new-password"
                required>
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                id="update_password_password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                required>
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Save Changes
            </button>

            @if (session('status') === 'password-updated')
                <p class="bg-success text-white p-2 small mb-0" style="border-radius: 6px;" id="password-updated-msg">Password updated successfully.</p>
                <script>
                    setTimeout(() => {
                        document.getElementById('password-updated-msg')?.remove();
                    }, 5000);
                </script>
            @endif
        </div>
    </form>
</section>

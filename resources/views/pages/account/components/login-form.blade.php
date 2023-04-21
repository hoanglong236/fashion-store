<form action="{{ route('login.handler') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email" class="form-label">Email(*)</label>
        <input id="email" class="form-control" name="email" value="{{ old('email') }}" type="email"
            placeholder="Email" required>
        @error('email')
            <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password" class="form-label">Password(*)</label>
        <input id="password" class="form-control" name="password" type="password" placeholder="Password" required>
        @error('password')
            <div class="alert alert-danger mt-1" role="alert">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn action-btn register-btn mt-3">Login</button>
</form>

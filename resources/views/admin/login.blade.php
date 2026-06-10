<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — {{ $siteTitle ?? 'Kementerian Haji dan Umrah Kabupaten Purbalingga' }}</title>
    <link rel="icon" type="image/png" href="{{ $siteFavicon ?? asset('images/logo-kemenhaj.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css'])
</head>
<body class="admin-body">
    <div class="login-wrap">
        <div class="login-card">
            <h1>Login Admin</h1>
            <p class="subtitle">Kementerian Haji dan Umrah Kab. Purbalingga</p>

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember" style="margin:0;">Ingat saya</label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;">Masuk</button>
            </form>
        </div>
    </div>
</body>
</html>

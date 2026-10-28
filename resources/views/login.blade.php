<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bi-Kantin - Login</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #ffffff; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; }
        .card { background: #ffffff; border: 1px solid #E0E0E0; border-radius: 12px; padding: 40px 30px; width: 100%; max-width: 420px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .title { color: #8B1818; font-size: 24px; font-weight: bold; margin-bottom: 6px; }
        .subtitle { color: #A0A0A0; font-size: 13px; margin-bottom: 25px; line-height: 1.4; }
        .form-group { text-align: left; margin-bottom: 18px; }
        .form-group label { display: block; font-weight: bold; font-size: 14px; margin-bottom: 8px; color: #333; }
        .form-control { width: 100%; padding: 12px 14px; border: 1px solid #D1D1D1; border-radius: 6px; font-size: 14px; outline: none; box-sizing: border-box; }
        .form-control::placeholder { color: #C4C4C4; }
        .btn-submit { background-color: #8B1818; color: white; border: none; padding: 12px; width: 100%; border-radius: 20px; font-weight: bold; font-size: 15px; cursor: pointer; margin-top: 15px; transition: 0.2s; }
        .btn-submit:hover { background-color: #6d1212; }
        .link-register { display: inline-block; margin-top: 25px; color: #8B1818; font-weight: bold; font-size: 13px; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <div class="title">Bi-Kantin</div>
    <div class="subtitle">Selamat Datang! Silahkan Masuk Dengan<br>Akun Anda</div>

    @if(session('error'))
        <div style="color: red; font-size: 13px; margin-bottom: 15px;">{{ session('error') }}</div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukan Username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required>
        </div>
        <button type="submit" class="btn-submit">Login</button>
    </form>

    <a href="/register" class="link-register">Buat Akun</a>
</div>

</body>
</html>
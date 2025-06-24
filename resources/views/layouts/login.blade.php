<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Poliklinik Wong Mumet</title>
    @include('layouts.lib.ext_css')
    <style>
        body {
            background-color: #0d47a1;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-box {
            width: 360px;
            margin: 7% auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }
        .login-logo a {
            color: #0d47a1;
            font-weight: 700;
            font-size: 2rem;
            display: block;
            text-align: center;
            margin-bottom: 1rem;
        }
        .login-card-body {
            color: #333;
        }
        .login-box-msg {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #0d47a1;
        }
        .btn-primary {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }
        .btn-primary:hover {
            background-color: #094a8f;
            border-color: #094a8f;
        }
        .input-group-text {
            background-color: #0d47a1;
            color: white;
            border: none;
        }
        .form-control:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 0 0.2rem rgba(13, 71, 161, 0.25);
        }
        a {
            color: #0d47a1;
        }
        a:hover {
            color: #094a8f;
            text-decoration: underline;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Poliklinik Wong Mumet</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                @php
                    $type = request()->query('type', 'admin');
                @endphp

                @if ($type === 'pasien')
                    <p class="login-box-msg">Pasien tercinta, silakan login.</p>
                    <p>Belum punya akun? <a href="{{ url('/register?type=pasien') }}">Registrasi disini</a></p>
                @elseif ($type === 'dokter')
                    <p class="login-box-msg">Selamat datang Dokter, silakan login menggunakan akun yang telah dibuatkan oleh admin.</p>
                @else
                    <p class="login-box-msg">Admin, silakan login menggunakan akun admin yang sudah dibuat.</p>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <!-- Optional remember me checkbox -->
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>

                <div class="d-flex align-items-center my-3">
                    <hr class="flex-grow-1">
                    <span class="px-2 text-muted">OR</span>
                    <hr class="flex-grow-1">
                </div>
                <div class="social-auth-links text-center">
                    <a href="/auth/redirect" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign In using Google+
                    </a>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.lib.ext_js')
</body>

</html>

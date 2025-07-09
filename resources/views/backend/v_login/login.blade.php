<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/icon_univ_bsi.png') }}">
    <title>Login Admin - MTV Carbon Pro</title>
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/libs/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0e7ef 0%, #f8fafc 100%);
            font-family: 'Hind', Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            padding: 40px 32px 32px 32px;
            position: relative;
        }

        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .login-title {
            text-align: center;
            font-size: 1.7rem;
            font-weight: 700;
            color: #D10024;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            border: 1px solid #e0e0e0;
            margin-bottom: 18px;
            background: #f8fafc;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #D10024;
            box-shadow: 0 0 0 2px rgba(209, 0, 36, 0.08);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            background: #D10024;
            color: #fff;
            border: none;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(209, 0, 36, 0.08);
        }

        .btn-login:hover {
            background: #b3001f;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.98rem;
            margin-bottom: 18px;
        }

        .input-group-text {
            border-radius: 8px 0 0 8px;
            background: #f1f1f1;
            color: #D10024;
            border: 1px solid #e0e0e0;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.95rem;
            margin-top: -12px;
            margin-bottom: 10px;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #888;
            font-size: 0.97rem;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>


<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="{{ asset('backend/images/logo.png') }}" alt="Logo MTV Carbon Pro">
        </div>
        <div class="login-title">Login Admin</div>
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form action="{{ route('backend.login') }}" method="post" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="email" id="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                        autofocus>
                </div>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                </div>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-login mt-2">Login</button>
        </form>
        <div class="login-footer mt-4">
            &copy; {{ date('Y') }} MTV Carbon Pro. All rights reserved.
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>

</html>

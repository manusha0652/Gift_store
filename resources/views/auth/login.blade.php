<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>Login - SoulGift</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 30px auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .brand-side {
            background: linear-gradient(135deg, #ff5722, #e64a19);
            color: #fff;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .brand-side h1 {
            font-size: 36px;
            margin: 20px 0;
            font-weight: 700;
        }

        .brand-side p {
            font-size: 16px;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .form-side {
            background-color: #fff;
            padding: 40px;
        }
        .form-side img {
            margin-left: 46%;
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #ff5722;
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 87, 34, 0.2);
        }

        .form-error {
            color: #d32f2f;
            font-size: 12px;
            margin-top: 5px;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .register-link {
            color: #555;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .register-link:hover {
            color: #ff5722;
            text-decoration: underline;
        }

        .login-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-btn:hover {
            background-color: #e64a19;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .features {
            margin-top: 30px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .remember-me input {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        .forgot-password {
            margin-top: 15px;
            text-align: right;
        }

        .forgot-password a {
            color: #555;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .forgot-password a:hover {
            color: #ff5722;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 500px;
            }

            .brand-side {
                padding: 30px;
                display: none;
            }

            .form-side {
                padding: 30px;
            }

            .mobile-logo {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }

            .mobile-logo img {
                width: 80px;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand-side">
            <div class="logo">
                <img src="{{ asset('images/nuw_logo.png') }}" alt="SoulGift Logo">
            </div>
            <h1>SoulGift</h1>
            <p>Welcome back! Log in to continue your soulful shopping experience.</p>
            
            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>Access your saved items</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>View your order history</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>See what our users say about us in the testimonials section</span>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">✓</div>
                    <span>Exclusive member discounts</span>
                </div>
            </div>
        </div>
        <div class="form-side">
            <div class="mobile-logo">
                <img src="{{ asset('images/nuw_logo.png') }}" alt="SoulGift Logo">
            </div>
            <div class="form-header">
                <h2>Welcome Back</h2>
                <p>Sign in to your SoulGift account</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email address">
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Remember me</label>
                </div>
                
                <div class="forgot-password">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                </div>
                
                <div class="form-footer">
                    <a class="register-link" href="{{ route('register') }}">
                        Don't have an account? Register
                    </a>
                    <button type="submit" class="login-btn">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
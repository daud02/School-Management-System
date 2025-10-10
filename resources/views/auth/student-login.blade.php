<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - I.E.T Government High School Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px;
            width: 90%;
            display: flex;
        }

        .login-left {
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            padding: 60px 40px;
            color: white;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .login-left h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .login-left p {
            font-size: 1.1rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        .login-left i {
            font-size: 5rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .login-right {
            padding: 60px 50px;
            flex: 1;
        }

        .login-right h3 {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .login-right .text-muted {
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            width: 100%;
            background: transparent;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.15);
            outline: none;
        }

        .form-label {
            position: absolute;
            left: 15px;
            top: 12px;
            color: #999;
            font-size: 0.95rem;
            font-weight: 400;
            pointer-events: none;
            transition: all 0.3s ease;
            background: white;
            padding: 0 5px;
        }

        .form-control:focus+.form-label,
        .form-control:not(:placeholder-shown)+.form-label {
            top: -10px;
            left: 10px;
            font-size: 0.8rem;
            color: #2563eb;
            font-weight: 600;
        }

        .btn-login {
            background: transparent;
            color: #2563eb;
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #2563eb;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            width: 100%;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #2563eb 0%, #0284c7 100%);
            border-radius: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .btn-login:hover::before {
            opacity: 1;
        }

        .btn-login:hover {
            color: white;
            border-color: #2563eb;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
        }

        .form-check-input:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .switch-login {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .switch-login a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .switch-login a:hover {
            color: #0284c7;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                padding: 40px 30px;
            }

            .login-left i {
                font-size: 3.5rem;
                margin-bottom: 20px;
            }

            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="login-left">
            <img src="{{ asset('images/logo.jpg') }}" alt="School Logo" class="mb-4" style="width: 130px; height: 130px; object-fit: contain; border-radius: 20px; background: rgba(255,255,255,0.25); padding: 15px; box-shadow: 0 8px 30px rgba(0,0,0,0.3);">
            <h2>I.E.T Government High School</h2>
            <p>Student Portal - Access your portal to view grades, attendance, routine, and more.</p>
        </div>

        <!-- Right Side -->
        <div class="login-right">
            <h3 class="mb-4">Student Login</h3>

            <form action="{{ route('student.dashboard') }}" method="GET">
                <div class="form-group">
                    <input class="form-control" id="studentId" type="text" placeholder=" " required>
                    <label class="form-label" for="studentId">Student Phone Number</label>
                </div>

                <div class="form-group">
                    <input class="form-control" id="password" type="password" placeholder=" " required>
                    <label class="form-label" for="password">Password</label>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" id="remember" type="checkbox">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <a class="text-decoration-none" href="#" style="color: #2563eb;">Forgot Password?</a>
                </div>

                <button class="btn btn-login" type="submit">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </button>
            </form>

            <div class="switch-login">
                <p>Are you an admin? <a href="{{ route('admin.login') }}">Login as Admin</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

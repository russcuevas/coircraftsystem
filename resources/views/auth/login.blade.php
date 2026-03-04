<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-image {
            background: linear-gradient(rgba(26, 48, 32, 0.4), rgba(26, 48, 32, 0.4)),
                url('https://images.unsplash.com/photo-1599148400620-8e1ff0bf28d8?auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .login-form-section {
            padding: 3rem;
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.25rem rgba(212, 188, 142, 0.25);
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-block login-image">
                <div class="h-100 d-flex flex-column justify-content-center align-items-center text-white p-5">
                    <h2 class="display-4 fw-bold">Welcome!</h2>
                    <p class="fs-5 text-center opacity-75">Continue your journey toward a more sustainable lifestyle
                        with our premium coir products.</p>
                </div>
            </div>

            <div class="col-lg-6 bg-white login-container">
                <div class="login-form-section w-100 mx-auto" style="max-width: 500px;">
                    <div class="text-center mb-5">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="CoirCraft" height="60" class="mb-4">
                        </a>
                        <h3 class="fw-bold">Sign In</h3>
                        <p class="text-muted">Enter your credentials to access your account</p>
                    </div>

                    <form action="/login" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="bi bi-envelope text-muted"></i></span>
                                <input type="email" class="form-control bg-light border-start-0"
                                    placeholder="name@example.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i
                                        class="bi bi-lock text-muted"></i></span>
                                <input type="password" class="form-control bg-light border-start-0"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">

                            </div>
                            <a href="#" class="small text-decoration-none fw-bold"
                                style="color: var(--primary-green);">Forgot password?</a>
                        </div>

                        <button type="submit" class="btn btn-gold w-100 py-3 mb-4">
                            Sign In <i class="bi bi-box-arrow-in-right ms-2"></i>
                        </button>


                        <p class="text-center text-muted mb-0">
                            Don't have an account?
                            <a href="/register" class="fw-bold text-decoration-none"
                                style="color: var(--primary-green);">Create Account</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

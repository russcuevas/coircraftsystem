<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | CoirCraft PH</title>
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
            background: linear-gradient(rgba(26, 48, 32, 0.7), rgba(26, 48, 32, 0.7)),
                url('https://images.unsplash.com/photo-1599148400620-8e1ff0bf28d8?auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .login-form-section {
            padding: 3rem;
        }

        .form-control:focus {
            border-color: #d4bc8e;
            box-shadow: 0 0 0 0.25rem rgba(212, 188, 142, 0.25);
        }

        .admin-badge {
            background-color: #1a3020;
            color: #d4bc8e;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 0.8rem;
            letter-spacing: 1px;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-block login-image">
                <div
                    class="h-100 d-flex flex-column justify-content-center align-items-center text-white p-5 text-center">
                    <h2 class="display-5 fw-bold mb-3">Management Dashboard</h2>
                    <p class="fs-5 opacity-75">Access CoirCraft PH internal tools to monitor inventory, process orders,
                        and manage storefront operations.</p>
                </div>
            </div>

            <div class="col-lg-6 bg-white login-container">
                <div class="login-form-section w-100 mx-auto" style="max-width: 500px;">
                    <div class="text-center mb-5">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="CoirCraft" height="70" class="mb-3">
                        </a>
                        <div class="mb-3">
                            <span class="admin-badge text-uppercase">Admin Access Only</span>
                        </div>
                        <h3 class="fw-bold">Welcome Back, Admin</h3>
                        <p class="text-muted">Please sign in to manage your shop.</p>
                    </div>

                    <form action="/admin/login" method="POST">
                        @csrf <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase">Admin Username / Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-person-badge text-muted"></i>
                                </span>
                                <input type="email" name="email" class="form-control bg-light border-start-0 py-2"
                                    placeholder="admin@coircraft.ph" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-uppercase">Secure Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-shield-lock text-muted"></i>
                                </span>
                                <input type="password" name="password" class="form-control bg-light border-start-0 py-2"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 mb-4 shadow-sm"
                            style="background-color: #1a3020; border: none;">
                            Authorized Login <i class="bi bi-key ms-2"></i>
                        </button>

                        <div class="text-center">
                            <a href="/" class="text-muted small text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i> Back to Main Website
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-image {
            background: linear-gradient(rgba(26, 48, 32, 0.4), rgba(26, 48, 32, 0.4)),
                url('https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&q=80');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }

        .register-form-section {
            padding: 2rem 3rem;
        }

        .form-control:focus {
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 0.25rem rgba(212, 188, 142, 0.25);
        }

        /* Custom styling for the scrollbar on the form side if content overflows */
        .register-container {
            overflow-y: auto;
        }

        /* Loading overlay */
#loadingOverlay {
    display: none; /* hide initially */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primary-green);
    flex-direction: column;
}

        #loadingOverlay .spinner-border {
            width: 3rem;
            height: 3rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="bg-light">

    <div id="loadingOverlay">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        Registration processing... please wait
    </div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-lg-5 d-none d-lg-block register-image">
                <div
                    class="h-100 d-flex flex-column justify-content-center align-items-center text-white p-5 text-center">
                    <h2 class="display-4 fw-bold">Join the Green Movement</h2>
                    <p class="fs-5 opacity-75">Create an account to track orders and receive updates on our latest
                        eco-friendly innovations.</p>
                </div>
            </div>


            <div class="col-lg-7 bg-white register-container">
                <div class="register-form-section w-100 mx-auto" style="max-width: 600px;">
                    <div class="text-center mb-4">
                        <a href="/">
                            <img src="{{ asset('images/logo.png') }}" alt="CoirCraft" height="50" class="mb-3">
                        </a>
                        <h3 class="fw-bold">Create Account</h3>
                        <p class="text-muted">Fill in your details to get started</p>
                    </div>

                    <form action="{{ route('auth.register.request') }}" method="POST">
                        @csrf <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Complete Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-person text-muted"></i></span>
                                    <input type="text" name="name" class="form-control bg-light border-start-0"
                                        placeholder="Juan Dela Cruz" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control bg-light border-start-0"
                                        placeholder="juan@example.com" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mobile Number</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-phone text-muted"></i></span>
                                    <input type="tel" name="phone" class="form-control bg-light border-start-0"
                                        placeholder="09123456789" pattern="[0-9]{11}"
                                        title="Please enter a valid 11-digit mobile number" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Complete Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-geo-alt text-muted"></i></span>
                                    <textarea name="address" class="form-control bg-light border-start-0" rows="2"
                                        placeholder="House No., Street, Brgy, City, Province" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control bg-light border-start-0"
                                        placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-shield-lock text-muted"></i></span>
                                    <input type="password" name="password_confirmation"
                                        class="form-control bg-light border-start-0" placeholder="••••••••" required>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-gold w-100 py-3 mt-4 mb-4">
                            Register Account <i class="bi bi-person-plus ms-2"></i>
                        </button>

                        <p class="text-center text-muted mb-0">
                            Already have an account?
                            <a href="/login" class="fw-bold text-decoration-none"
                                style="color: var(--primary-green);">Sign In</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        const notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top'
            },
            dismissible: true
        });

        @if (session('success'))
            notyf.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            notyf.error("{{ session('error') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const overlay = document.getElementById('loadingOverlay');

        if(form){
            form.addEventListener('submit', function() {
                overlay.style.display = 'flex';
            });
        }
    });
    </script>
</body>

</html>

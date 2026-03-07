<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .profile-card {
            max-width: 600px;
            margin: 40px auto;
        }

        .btn-update {
            background-color: #d4bc8e;
            color: #1a3020;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #bfa36a;
            color: #fff;
        }

        .form-control[readonly] {
            background-color: #f8f9fa !important;
        }
    </style>
</head>
<body>
    @include('navbar')

    <div class="container">
        <div class="card profile-card p-4 shadow-sm">
            <h3 class="fw-bold mb-4 text-center">My Profile</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="form-control" 
                        value="{{ old('fullname', Auth::user()->fullname) }}" required>
                    @error('fullname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" 
                        value="{{ old('email', Auth::user()->email) }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Complete Address</label>
                    <input type="text" name="address" id="address" class="form-control" 
                        value="{{ old('address', Auth::user()->address) }}" required>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" 
                        value="{{ old('phone_number', Auth::user()->phone_number) }}" required>
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-update">Update Profile</button>
                </div>
            </form>
        </div>
    </div>

    @include('footer')
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
    </script>
</body>
</html>
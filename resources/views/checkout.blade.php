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
        .cart-summary-card {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .cart-summary-card::-webkit-scrollbar {
            width: 6px;
        }

        .cart-summary-card::-webkit-scrollbar-thumb {
            background-color: rgba(26, 48, 32, 0.5);
            border-radius: 3px;
        }

        .cart-summary-card::-webkit-scrollbar-track {
            background: transparent;
        }

        .back-cart-btn {
            display: inline-block;
            padding: 10px 18px;
            background-color: #d4bc8e;
            color: #1a3020;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease;
            margin-bottom: 10px;
        }

        .back-cart-btn:hover {
            background-color: white;
        }
    </style>
</head>

<body>
    @include('navbar')

    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="profileForm" action="{{ route('checkout.profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">Change details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="modal_fullname" class="form-label">Full Name</label>
                            <input type="text" name="fullname" id="modal_fullname" class="form-control"
                                value="{{ Auth::user()->fullname }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="modal_email" class="form-label">Email</label>
                            <input type="email" name="email" id="modal_email" class="form-control"
                                value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="modal_address" class="form-label">Address</label>
                            <input type="text" name="address" id="modal_address" class="form-control"
                                value="{{ Auth::user()->address }}" required>
                        </div>
                        <div class="mb-2">
                            <label for="modal_phone" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="modal_phone" class="form-control"
                                value="{{ Auth::user()->phone_number }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-gold w-100">Change details</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="shop-section">
        <div class="container">
            <a href="/cart" class="back-cart-btn">← Back to Cart</a>
            <h3 class="mb-4">Checkout</h3>

            @if ($cartItems->isEmpty())
                <div class="alert alert-warning text-center">
                    Your cart is empty.
                </div>
            @else
                <div class="row g-4">
                    <!-- Left: User Details & Payment -->
                    <div class="col-lg-8">
                        <form action="{{ route('checkout.request') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card p-3 mb-3">
                                <h5 class="fw-bold mb-3 d-flex justify-content-between align-items-center">
                                    Shipping & Contact Details
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                        data-bs-toggle="modal" data-bs-target="#profileModal">
                                        Change details
                                    </button>
                                </h5>

                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="mb-2">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input style="background-color: gray; color: white;" type="text" name="fullname"
                                        id="fullname" class="form-control" value="{{ Auth::user()->fullname }}"
                                        required readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input style="background-color: gray; color: white;" type="email"
                                        name="email" id="email" class="form-control"
                                        value="{{ Auth::user()->email }}" required readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="address" class="form-label">Address</label>
                                    <input style="background-color: gray; color: white;" type="text"
                                        name="address" id="address" class="form-control"
                                        value="{{ Auth::user()->address }}" required readonly>
                                </div>
                                <div class="mb-2">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input style="background-color: gray; color: white;" type="text"
                                        name="phone_number" id="phone_number" class="form-control"
                                        value="{{ Auth::user()->phone_number }}" required readonly>
                                </div>
                            </div>

                            <div class="card p-3 mb-3">
                                <h5 class="fw-bold mb-3">Payment Method</h5>
                                <select name="payment_method" id="payment_method" class="form-select mb-2" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="GCash">GCash</option>
                                </select>

                                <!-- GCASH Section -->
                                <div id="gcash_section" style="display: none;">
                                    <div class="mb-2 text-left">
                                        <img src="{{ asset('qr-code.jpeg') }}" alt="GCash QR Code"
                                            style="max-width: 200px;">
                                    </div>
                                    <p class="text-muted small">
                                        Tutorial: Scan the QR code using your GCash app and upload a screenshot of your
                                        payment as proof.
                                    </p>
                                    <div class="mb-2">
                                        <label for="payment_proof" class="form-label">Payment Proof</label>
                                        <input type="file" name="payment_proof" id="payment_proof"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="card p-3 mb-3">
                                <h5 class="fw-bold mb-3">Delivery Method</h5>
                                <select name="delivery_method" class="form-select mb-2" required>
                                    <option value="">Select Delivery Method</option>
                                    <option value="Delivery">Delivery</option>
                                    <option value="Pickup">Pickup</option>
                                </select>
                            </div>

                    </div>

                    <!-- Right: Cart Summary -->
                    <div class="col-lg-4">
                        <div class="card p-3 cart-summary-card">
                            <h5 class="fw-bold mb-3">Order Summary</h5>
                            @php
                                $subtotal = $cartItems->sum(function ($item) {
                                    return $item->product_price * $item->quantity;
                                });
                            @endphp

                            @foreach ($cartItems as $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $item->product_name }} (x{{ $item->quantity }})</span>
                                    <span>₱{{ number_format($item->product_price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach

                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Delivery:</span>
                                <span>
                                    Free
                                </span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold mb-2">
                                <span>Total:</span>
                                <span>₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <button type="submit" class="btn btn-gold w-100 mb-3">Place Order</button>
                            </form>

                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profileForm = document.getElementById('profileForm');

            const notyf = new Notyf({
                duration: 4000,
                position: {
                    x: 'right',
                    y: 'top'
                },
                dismissible: true
            });

            profileForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(profileForm);

                fetch(profileForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(res => {
                        if (!res.ok) throw res;
                        return res.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                'profileModal'));
                            modal.hide();
                            document.getElementById('fullname').value = formData.get('fullname');
                            document.getElementById('email').value = formData.get('email');
                            document.getElementById('address').value = formData.get('address');
                            document.getElementById('phone_number').value = formData.get(
                            'phone_number');
                            notyf.success('Profile updated successfully!');
                        }
                    })
                    .catch(async err => {
                        if (err.json) {
                            const errorData = await err.json();
                            let message = '';
                            for (let field in errorData.errors) {
                                message += `${errorData.errors[field].join(', ')}\n`;
                            }
                            notyf.error(message);
                        } else {
                            console.error(err);
                            notyf.error('An unexpected error occurred.');
                        }
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethod = document.getElementById('payment_method');
            const gcashSection = document.getElementById('gcash_section');

            function togglePaymentSection() {
                if (paymentMethod.value === 'GCash') {
                    gcashSection.style.display = 'block';
                } else {
                    gcashSection.style.display = 'none';
                    document.getElementById('payment_proof').value = '';
                }
            }

            paymentMethod.addEventListener('change', togglePaymentSection);
            togglePaymentSection();
        });
    </script>
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

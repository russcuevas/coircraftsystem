<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - CoirCraft PH</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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
    </style>
</head>

<body>
    @include('navbar')

    <section class="shop-section">
        <div class="container">
            <h3 class="mb-4">Checkout</h3>

            @if ($cartItems->isEmpty())
                <div class="alert alert-warning text-center">
                    Your cart is empty.
                </div>
            @else
                <div class="row g-4">
                    <!-- Left: User Details & Payment -->
                    <div class="col-lg-8">
                        <form action="{{ route('checkout.placeOrder') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card p-3 mb-3">
                                <h5 class="fw-bold mb-3">Shipping & Contact Details</h5>

                                <div class="mb-2">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control"
                                        value="{{ Auth::user()->fullname }}" required>
                                </div>

                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ Auth::user()->email }}" required>
                                </div>

                                <div class="mb-2">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{ Auth::user()->address }}" required>
                                </div>

                                <div class="mb-2">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                                        value="{{ Auth::user()->phone_number }}" required>
                                </div>
                            </div>

                            <div class="card p-3 mb-3">
                                <h5 class="fw-bold mb-3">Payment Method</h5>
                                <select name="payment_method" class="form-select mb-2" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="GCash">GCash</option>
                                </select>

                                <div class="mb-2">
                                    <label for="payment_proof" class="form-label">Payment Proof (if applicable)</label>
                                    <input type="file" name="payment_proof" id="payment_proof" class="form-control">
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

                        </form>
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
                                <span>₱{{ number_format($subtotal >= 1500 ? $subtotal : $subtotal + 150, 2) }}</span>
                            </div>
                            <button type="submit" class="btn btn-gold w-100 mb-3">Place Order</button>

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

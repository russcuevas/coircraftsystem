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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <style>
        .cart-items-container {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .cart-items-container::-webkit-scrollbar {
            width: 6px;
        }

        .cart-items-container::-webkit-scrollbar-thumb {
            background-color: rgba(26, 48, 32, 0.5);
            border-radius: 3px;
        }

        .cart-items-container::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>

<body>
    @include('navbar')

    <section class="shop-section">
        <div class="container">
            <h3 class="mb-4">My Cart</h3>

            @if ($cartItems->isEmpty())
                <div class="alert alert-warning text-center">
                    Your cart is empty.
                </div>
            @else
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="cart-items-container"
                            style="max-height: 500px; overflow-y: auto; padding-right: 10px;">
                            @foreach ($cartItems as $item)
                                <div class="card mb-3 product-card-shop">
                                    <div class="row g-0 align-items-center">
                                        <div class="col-md-3">
                                            <img src="{{ asset('images/' . $item->product_image) }}"
                                                class="img-fluid rounded-start" style="height:120px; object-fit:cover;">
                                        </div>
                                        <div class="col-md-5">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">{{ $item->product_name }}</h6>
                                                <p class="text-muted mb-1">{{ $item->category_name }}</p>
                                                <p class="fw-bold mb-0">₱{{ number_format($item->product_price, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <form action="{{ route('cart.update', $item->product_id) }}" method="POST"
                                                class="d-flex justify-content-center align-items-center gap-2 mb-2">
                                                @csrf
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" class="form-control form-control-sm"
                                                    style="width:70px;">
                                                <button type="submit" class="btn btn-outline-dark btn-sm">
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i> Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card p-3">
                            <h5 class="fw-bold mb-3">Order Summary</h5>
                            @php
                                $subtotal = $cartItems->sum(function ($item) {
                                    return $item->product_price * $item->quantity;
                                });
                            @endphp
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
                            <div class="d-flex justify-content-between fw-bold mb-3">
                                <span>Total:</span>
                                <span>
                                    ₱{{ number_format($subtotal >= 1500 ? $subtotal : $subtotal + 150, 2) }}
                                </span>
                            </div>
                            <a href="{{ route('checkout.page') }}" class="btn btn-gold w-100">Proceed to Checkout</a>
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

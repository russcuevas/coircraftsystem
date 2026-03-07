<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports & Analytics | CoirCraft PH</title>

    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    @include('admin.navbar')

    <main class="main-content">
        <div class="container-fluid">

            <div class="mb-4">
                <h2 class="fw-bold">Reports & Analytics</h2>
                <p class="text-muted">Detailed breakdown of your store's performance.</p>
            </div>


            {{-- SALES CARDS --}}
            <div class="row g-4 mb-5">

                <div class="col-md-6">
                    <div class="card stat-card p-4 border-0 shadow-sm"
                        style="border-left:5px solid #198754 !important;">
                        <div class="d-flex align-items-center">

                            <div class="icon-box bg-success me-3">
                                <i class="bi bi-calendar-event"></i>
                            </div>

                            <div>
                                <small class="text-muted fw-bold text-uppercase">Total Sales (Today)</small>
                                <h2 class="fw-bold mb-0">
                                    ₱{{ number_format($todaySales, 2) }}
                                </h2>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="card stat-card p-4 border-0 shadow-sm"
                        style="border-left:5px solid #0d6efd !important;">
                        <div class="d-flex align-items-center">

                            <div class="icon-box bg-primary me-3">
                                <i class="bi bi-graph-up-arrow"></i>
                            </div>

                            <div>
                                <small class="text-muted fw-bold text-uppercase">
                                    Total Sales ({{ \Carbon\Carbon::now()->format('F Y') }})
                                </small>

                                <h2 class="fw-bold mb-0">
                                    ₱{{ number_format($monthlySales, 2) }}
                                </h2>

                            </div>

                        </div>
                    </div>
                </div>

            </div>


            {{-- CHARTS --}}
            <div class="row g-4 mb-5">

                <div class="col-lg-8">
                    <div class="card stat-card p-4 border-0 shadow-sm h-100">

                        <h5 class="fw-bold mb-4">Monthly Sales Trend</h5>

                        <canvas id="salesChart" style="max-height:300px;"></canvas>

                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="card stat-card p-4 border-0 shadow-sm h-100 text-center">

                        <h5 class="fw-bold mb-4">Stock Overview</h5>

                        <canvas id="inventoryChart"></canvas>

                        <div class="mt-4 small text-muted">
                            Total items across all categories
                        </div>

                    </div>
                </div>

            </div>


            {{-- INVENTORY REPORT --}}
            <div class="card stat-card border-0 p-4 shadow-sm">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Inventory Report Breakdown</h5>


                </div>


                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead class="table-light">
                            <tr class="small text-muted text-uppercase">
                                <th>Category</th>
                                <th>Total Products</th>
                                <th>Total Stock</th>
                                <th>Sold Count</th>
                                <th>Estimated Value</th>
                            </tr>
                        </thead>


                        <tbody>

                            @php
                                $totalProducts = 0;
                                $totalStock = 0;
                                $totalSold = 0;
                                $totalValue = 0;
                            @endphp


                            @foreach ($inventory as $item)
                                <tr>

                                    <td class="fw-bold">{{ $item->category_name }}</td>

                                    <td>{{ $item->total_products }}</td>

                                    <td>{{ $item->total_stock }} units</td>

                                    <td>{{ $item->sold_count }}</td>

                                    <td>₱{{ number_format($item->estimated_value, 2) }}</td>

                                </tr>

                                @php
                                    $totalProducts += $item->total_products;
                                    $totalStock += $item->total_stock;
                                    $totalSold += $item->sold_count;
                                    $totalValue += $item->estimated_value;
                                @endphp
                            @endforeach

                        </tbody>


                        <tfoot class="table-light fw-bold">

                            <tr>

                                <td>TOTAL</td>

                                <td>{{ $totalProducts }}</td>

                                <td>{{ $totalStock }} units</td>

                                <td>{{ $totalSold }}</td>

                                <td>₱{{ number_format($totalValue, 2) }}</td>

                            </tr>

                        </tfoot>

                    </table>

                </div>
            </div>

        </div>
    </main>


    <script>
        const weeklySales = {!! json_encode($weeklySales) !!};

        const salesCtx = document.getElementById('salesChart').getContext('2d');

        new Chart(salesCtx, {
            type: 'line',

            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],

                datasets: [{
                    label: 'Sales (₱)',
                    data: weeklySales,
                    borderColor: '#1a3020',
                    backgroundColor: 'rgba(212,188,142,0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });



        const invCtx = document.getElementById('inventoryChart').getContext('2d');

        new Chart(invCtx, {
            type: 'doughnut',

            data: {
                labels: ['Available', 'Low Stock', 'Out of Stock'],

                datasets: [{
                    data: [
                        {{ $availableStock }},
                        {{ $lowStock }},
                        {{ $outStock }}
                    ],

                    backgroundColor: [
                        '#198754',
                        '#ffc107',
                        '#dc3545'
                    ],

                    borderWidth: 0
                }]
            },

            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }

        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

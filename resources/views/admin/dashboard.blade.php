@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Produk Terjual</h5>
                    <p class="card-text">{{ number_format($totalProductsSold, 0, ',', '.') ?? '0' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Produk Terlaris</h5>
                    <p class="card-text">{{ $topSellingProduct->nama ?? 'Tidak ada data' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Line Chart Penjualan (Berdasarkan Bulan)</h5>
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Pie Chart Berdasarkan Rating</h5>
                    <canvas id="ratingChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Komentar Pengguna</h5>
                    <div class="comments-container" style="max-height: 500px; overflow-y: auto;">
                        @foreach ($comments as $comment)
                            <p class="card-text mb-20">
                                <strong>{{ $comment->user->name }}</strong> (Produk: {{ $comment->product->nama }})
                                <br>{{ $comment->comment }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Line Chart (default by bulan)
    const salesChartCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesChartCtx, {
        type: 'line',
        data: {
            labels: @json($salesData->pluck('label')),
            datasets: [{
                label: 'Jumlah Penjualan',
                data: @json($salesData->pluck('value')),
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Pie Chart
    const ratingChartCtx = document.getElementById('ratingChart').getContext('2d');
    new Chart(ratingChartCtx, {
        type: 'pie',
        data: {
            labels: @json($ratingDistribution->pluck('label')),
            datasets: [{
                data: @json($ratingDistribution->pluck('value')),
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        }
    });
</script>
@endsection

@extends('layouts.admin')
@php
   $chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$chartData = [45, 67, 53, 80, 72, 90, 110, 95, 76, 60, 88, 102];
   $totalUsers = rand(100,2000); 
   $totalPosts = rand(2000,10000); 
   $todaysPosts = rand(5,200); 
   $pendingPosts = rand(10,150); 
@endphp
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-6">Admin Dashboard</h1>

    <!-- Row 1: Demographics Chart -->
    <div class="bg-white rounded-xl shadow p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Monthly Post Demographics</h2>
        <canvas id="postsChart"></canvas>
    </div>

    <!-- Row 2: KPIs -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- KPI 1 -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-medium text-gray-700">Total Users</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</p>
        </div>

        <!-- KPI 2 -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-medium text-gray-700">Total Posts</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalPosts }}</p>
        </div>

        <!-- KPI 3 -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-medium text-gray-700">Today's Posts</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $todaysPosts }}</p>
        </div>

        <!-- KPI 4 -->
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-medium text-gray-700">Pending Posts</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $pendingPosts }}</p>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('postsChart').getContext('2d');
    const postsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Posts Per Month',
                data: {!! json_encode($chartData) !!},
                borderColor: 'rgba(99, 102, 241, 1)',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection

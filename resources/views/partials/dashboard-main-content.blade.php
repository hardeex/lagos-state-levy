<div class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">My Lagos State Levy Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @php
                $stats = [
                    ['title' => 'Total Revenue', 'value' => 'NGN 1,234,567', 'change' => 5.2],
                    ['title' => 'Average Levy', 'value' => 'NGN 456', 'change' => -2.1],
                    ['title' => 'Compliance Rate', 'value' => '92%', 'change' => 1.5],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-600 mb-2">{{ $stat['title'] }}</h3>
                    <p class="text-3xl font-bold text-gray-800">{{ $stat['value'] }}</p>
                    <p class="text-sm {{ $stat['change'] >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                        @if ($stat['change'] >= 0)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        @endif
                        {{ abs($stat['change']) }}% from last month
                    </p>
                </div>
            @endforeach
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Monthly Levy Collection</h2>
            <canvas id="levyChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('levyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Levy Amount ($)',
                    data: [12000, 19000, 15000, 17000, 16000, 20000],
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
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
    </script>
</div>

</html>

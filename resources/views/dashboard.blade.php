<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- 🔵 3 Info Cards with Color & Icons -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100 p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-blue-200 dark:bg-blue-800 p-3 rounded-full">
                        <!-- Cube Icon -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M20 13V7a2 2 0 00-2-2h-4m0 0H6a2 2 0 00-2 2v6m0 0v6a2 2 0 002 2h12a2 2 0 002-2v-6M10 21V9m4 0v12"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Produk</h3>
                        <p class="text-3xl font-bold">120</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-green-200 dark:bg-green-800 p-3 rounded-full">
                        <!-- Cash Icon -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 8c-1.104 0-2 .672-2 1.5S10.896 11 12 11s2 .672 2 1.5S13.104 14 12 14s-2 .672-2 1.5S10.896 17 12 17s2-.672 2-1.5"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Penjualan</h3>
                        <p class="text-3xl font-bold">Rp 45.000.000</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-100 p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-yellow-200 dark:bg-yellow-800 p-3 rounded-full">
                        <!-- User Icon -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A8.966 8.966 0 0112 15c2.216 0 4.253.805 5.879 2.136M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Total Pelanggan</h3>
                        <p class="text-3xl font-bold">230</p>
                    </div>
                </div>
            </div>

            <!-- 📈 Grafik dan Diagram Sejajar -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Grafik Penjualan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Grafik Penjualan Bulanan</h3>
                    <div class="h-64">
                        <canvas id="salesBarChart"></canvas>
                    </div>
                </div>

                <!-- Diagram Penjualan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Distribusi Penjualan Produk</h3>
                    <div class="flex justify-center items-center h-64">
                        <canvas id="salesPieChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- 📊 Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Bar Chart (Penjualan Bulanan)
        const ctxBar = document.getElementById('salesBarChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: [5000000, 7000000, 6000000, 8000000, 7500000, 9000000],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Pie Chart (Distribusi Produk)
        const ctxPie = document.getElementById('salesPieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Produk A', 'Produk B', 'Produk C'],
                datasets: [{
                    data: [40, 35, 25],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(251, 191, 36, 0.7)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'rgba(31, 41, 55, 0.9)', // gray-800
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>

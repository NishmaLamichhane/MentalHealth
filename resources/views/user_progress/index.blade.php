@extends('layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Title -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800"><i class="ri-progress-5-line pr-2"></i>My Progress</h1>
        <a href="{{ route('user_progress.create') }}" 
           class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition duration-200">
           Add Progress
        </a>
    </div>

    <!-- Responsive Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg mb-6">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase">Date</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase">Title</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase">Description</th>
                    <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($progress as $item)
                    <tr class="hover:bg-gray-100 border-b border-gray-200">
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $item->progress_date }}</td>
                        <td class="py-3 px-6 text-sm font-semibold text-gray-800">{{ $item->progress_title }}</td>
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $item->description }}</td>
                        <td class="py-3 px-6 text-sm">
                            <a href="{{ route('user_progress.edit', $item->id) }}" 
                               class="text-blue-500 hover:text-blue-700 mr-2">
                               Edit
                            </a>
                            <form action="{{ route('user_progress.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-500 hover:text-red-700" 
                                        onclick="return confirm('Are you sure you want to delete this progress?');">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $progress->links() }} <!-- Include pagination links here -->
    </div>

    <!-- Progress Charts -->
    <div class="container">
        <h2 class="text-lg font-semibold mb-4">Progress Overview</h2>

        @if (session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
            <!-- Bar Chart -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <canvas id="barChart" class="w-full h-72"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Bar Chart Configuration
            const barCtx = document.getElementById('barChart').getContext('2d');
            const barData = {
                labels: @json($dataCounts->keys()), // Dates or categories
                datasets: [{
                    label: 'Progress Count',
                    data: @json($dataCounts->values()), // Values for the bar chart
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            const barConfig = {
                type: 'bar',
                data: barData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date',
                                color: '#666',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Progress Count',
                                color: '#666',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            },
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                color: '#666'
                            }
                        }
                    }
                }
            };

            const barChart = new Chart(barCtx, barConfig);
        </script>
    </div>
</div>
@endsection

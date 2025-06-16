@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Inquiry Report ({{ ucfirst($filter) }})</h2>

    {{-- Filter --}}
    <form method="GET" action="{{ route('inquiries.report') }}" class="mb-4">
        <label for="filter" class="mr-2">Filter by:</label>
        <select name="filter" id="filter" onchange="this.form.submit()" class="border rounded px-2 py-1">
            <option value="monthly" {{ $filter == 'monthly' ? 'selected' : '' }}>Monthly</option>
            <option value="yearly" {{ $filter == 'yearly' ? 'selected' : '' }}>Yearly</option>
        </select>
    </form>

    @if(count($inquiries) > 0)
        {{-- Table Report by Period --}}
        <table class="w-full border text-left mb-6">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">Period</th>
                    <th class="px-4 py-2">Total Inquiries</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inquiries as $inquiry)
                    <tr>
                        <td class="px-4 py-2">{{ $inquiry->period }}</td>
                        <td class="px-4 py-2">{{ $inquiry->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Download buttons --}}
        <div class="mb-6">
            <a href="{{ route('inquiries.export.pdf', ['filter' => $filter]) }}" class="bg-red-500 text-white px-4 py-2 rounded">Download PDF</a>
            <a href="{{ route('inquiries.export.excel', ['filter' => $filter]) }}" class="bg-green-500 text-white px-4 py-2 rounded ml-2">Download Excel</a>
        </div>

        {{-- Pie Chart: Inquiry by Period --}}
        <h3 class="text-xl font-semibold mb-2">Chart: Inquiries by Period</h3>
        <div class="flex justify-center mb-8">
            <div class="chart-container">
                <canvas id="inquiryPieChartPeriod"></canvas>
            </div>
        </div>

        {{-- Table Summary by Status --}}
        @php
            $statusSummary = \App\Models\Inquiry::select('InquiryStatus', \DB::raw('count(*) as total'))
                                ->groupBy('InquiryStatus')
                                ->get();
            $statusLabels = $statusSummary->pluck('InquiryStatus');
            $statusCounts = $statusSummary->pluck('total');
        @endphp

        <h3 class="text-xl font-semibold mb-2">Total by Inquiry Status</h3>
        <table class="w-full border text-left mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Inquiry Status</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($statusSummary as $status)
                    <tr>
                        <td class="px-4 py-2">{{ $status->InquiryStatus }}</td>
                        <td class="px-4 py-2">{{ $status->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pie Chart: Inquiry by Status --}}
        <h3 class="text-xl font-semibold mb-2">Chart: Inquiries by Status</h3>
        <div class="flex justify-center">
            <div class="chart-container">
                <canvas id="inquiryPieChartStatus"></canvas>
            </div>
        </div>

        {{-- Chart Styles --}}
        <style>
            .chart-container {
                width: 350px;
                height: 350px;
                margin: auto;
                position: relative;
            }
        </style>

        {{-- Chart Scripts --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Pie chart by Period
            new Chart(document.getElementById('inquiryPieChartPeriod'), {
                type: 'pie',
                data: {
                    labels: @json($inquiries->pluck('period')),
                    datasets: [{
                        label: 'Total Inquiries',
                        data: @json($inquiries->pluck('total')),
                        backgroundColor: [
                            '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#6366f1', '#ec4899'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed}`;
                                }
                            }
                        }
                    }
                }
            });

            // Pie chart by Status
            new Chart(document.getElementById('inquiryPieChartStatus'), {
                type: 'pie',
                data: {
                    labels: @json($statusLabels),
                    datasets: [{
                        label: 'Total by Status',
                        data: @json($statusCounts),
                        backgroundColor: [
                            '#ef4444', '#10b981', '#f59e0b', '#6366f1', '#ec4899', '#3b82f6'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed}`;
                                }
                            }
                        }
                    }
                }
            });
        </script>

    @else
        <p class="text-gray-600">No inquiries found.</p>
    @endif
</div>
@endsection

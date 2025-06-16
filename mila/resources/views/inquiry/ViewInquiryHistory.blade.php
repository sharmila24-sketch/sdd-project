@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Inquiry History for: {{ $inquiry->InquiryTitle }}</h2>

    <table class="table-auto w-full border border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Notes</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($history as $log)
                <tr>
                    <td class="px-4 py-2 border">{{ $log->AssignmentDate }}</td>
                    <td class="px-4 py-2 border">{{ $log->AssignmentStatus }}</td>
                    <td class="px-4 py-2 border">{{ $log->AssignmentNotes }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 border text-center">No history found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>
@endsection

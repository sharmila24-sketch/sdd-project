@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">New Inquiries (Pending)</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse($inquiries as $inquiry)
    <div class="border rounded-lg p-4 mb-4 bg-white shadow">
        <h3 class="text-lg font-semibold">{{ $inquiry->InquiryTitle }}</h3>
        <p class="text-gray-700 mb-2">{{ $inquiry->InquiryDescription }}</p>

        <div class="text-sm text-gray-500 mb-1">
            <strong>Date:</strong> {{ \Carbon\Carbon::parse($inquiry->InquiryDate)->format('Y-m-d') }}
        </div>

        <div class="text-sm text-gray-500 mb-1">
            <strong>User ID:</strong> {{ $inquiry->UserID }}
        </div>

        <div class="mb-2">
            <strong>Evidence:</strong>
            @if($inquiry->InquiryEvidance)
                <a href="{{ asset('storage/' . $inquiry->InquiryEvidance) }}" target="_blank" class="text-blue-500 underline">View File</a>
            @else
                <span class="text-gray-400">No File</span>
            @endif
        </div>

        <!-- Action buttons -->
        <div class="mt-3 flex gap-2">
            <!-- Accept -->
            <form method="POST" action="{{ route('inquiries.validate', $inquiry->InquiryID) }}">
                @csrf
                <input type="hidden" name="action" value="valid">
                <button type="submit" class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">Accept</button>
            </form>

            <!-- Reject -->
            <form method="POST" action="{{ route('inquiries.validate', $inquiry->InquiryID) }}">
                @csrf
                <input type="hidden" name="action" value="non-serious">
                <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">Reject</button>
            </form>
        </div>
    </div>
    @empty
        <p class="text-gray-500">No new inquiries at the moment.</p>
    @endforelse
</div>
@endsection

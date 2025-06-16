@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Filtered Inquiries (Past Records)</h2>

    <form method="GET" class="flex flex-wrap gap-4 mb-4">
        <input type="date" name="date" value="{{ request('date') }}" class="border p-2 rounded">
        
        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="Valid" {{ request('status') == 'Valid' ? 'selected' : '' }}>Valid</option>
            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="Assigned" {{ request('status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
        </select>

        <input type="text" name="agency" placeholder="Search Agency" value="{{ request('agency') }}" class="border p-2 rounded">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
    </form>

    @forelse($inquiries as $inquiry)
    <div class="border rounded-lg p-4 mb-4 bg-white shadow">
        <h3 class="text-lg font-semibold">{{ $inquiry->InquiryTitle }}</h3>
        <p class="text-gray-700">{{ $inquiry->InquiryDescription }}</p>

        <div class="text-sm text-gray-500 mt-2">
            <strong>Date:</strong> {{ \Carbon\Carbon::parse($inquiry->InquiryDate)->format('Y-m-d') }} |
            <strong>Status:</strong> {{ $inquiry->InquiryStatus }} |
            <strong>Agency:</strong> {{ $inquiry->AssignedAgency ?? 'Not Assigned' }}
        </div>

        @if($inquiry->InquiryEvidance)
            <div class="mt-2">
                <strong>Evidence:</strong> 
                <a href="{{ asset('storage/' . $inquiry->InquiryEvidance) }}" class="text-blue-500 underline" target="_blank">View File</a>
            </div>
        @endif
    </div>
    @empty
        <p class="text-gray-500">No past inquiries match the filter.</p>
    @endforelse

    <div class="mt-4">
        {{ $inquiries->withQueryString()->links() }}
    </div>
</div>
@endsection

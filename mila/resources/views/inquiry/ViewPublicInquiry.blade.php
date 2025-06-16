@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Public Inquiries</h2>

    <!-- Filter form -->
    <form method="GET" class="mb-4 flex flex-wrap gap-4">
        <input type="text" name="title" placeholder="Search Title" value="{{ request('title') }}" class="border p-2 rounded" />
        <input type="date" name="date" value="{{ request('date') }}" class="border p-2 rounded" />
        <select name="status" class="border p-2 rounded">
            <option value="">-- Status --</option>
            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Valid" {{ request('status') == 'Valid' ? 'selected' : '' }}>Valid</option>
            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            <option value="Assigned" {{ request('status') == 'Assigned' ? 'selected' : '' }}>Assigned</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Inquiry table -->
    <table class="w-full border text-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Evidence</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inquiries as $inquiry)
            <tr>
                <td class="p-2 border">{{ $inquiry->InquiryTitle }}</td>
                <td class="p-2 border">{{ Str::limit($inquiry->InquiryDescription, 100) }}</td>
                <td class="p-2 border">{{ $inquiry->InquiryStatus }}</td>
                <td class="p-2 border">{{ \Carbon\Carbon::parse($inquiry->InquiryDate)->format('Y-m-d') }}</td>
                <td class="p-2 border">
                    @if($inquiry->InquiryEvidance)
                        <a href="{{ asset('storage/' . $inquiry->InquiryEvidance) }}" target="_blank" class="text-blue-500 underline">View</a>
                    @else
                        No file
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">No public inquiries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $inquiries->links() }}
    </div>
</div>
@endsection

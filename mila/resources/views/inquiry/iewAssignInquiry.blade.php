@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">📁 Assigned Inquiries</h2>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-white p-4 rounded-lg shadow mb-6">
        <select name="status" class="border rounded px-2 py-1">
            <option value="">-- Status --</option>
            <option value="under investigation">Under Investigation</option>
            <option value="verified as true">Verified as True</option>
            <option value="identified as fake">Identified as Fake</option>
            <option value="rejected">Rejected</option>
        </select>

        <input type="text" name="category" placeholder="Category/Subject" class="border rounded px-2 py-1">

        <input type="date" name="start_date" class="border rounded px-2 py-1">
        <input type="date" name="end_date" class="border rounded px-2 py-1">

        <div class="md:col-span-4 text-right">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Filter</button>
        </div>
    </form>

    @if($inquiries->count() > 0)
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full border">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border">Title</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inquiries as $inquiry)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border">{{ $inquiry->InquiryTitle }}</td>
                    <td class="px-4 py-2 border">{{ $inquiry->InquiryCategory }}</td>
                    <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($inquiry->InquiryDate)->format('d M Y') }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($inquiry->InquiryStatus) }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('inquiries.show', $inquiry->InquiryID) }}"
                           class="text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $inquiries->links() }}
        </div>
    </div>
    @else
        <p class="text-gray-600">No inquiries found for your filters.</p>
    @endif
</div>
@endsection

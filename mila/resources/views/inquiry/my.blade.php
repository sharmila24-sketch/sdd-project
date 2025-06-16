@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-4">Inkuiri Anda (UserID: {{ $userId }})</h2>

    @if($inquiries->isEmpty())
        <p>Tiada inkuiri dijumpai untuk pengguna ini.</p>
    @else
        <table class="table-auto w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Tajuk</th>
                    <th class="px-4 py-2">Keterangan</th>
                    <th class="px-4 py-2">Tarikh</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $inquiry)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $inquiry->InquiryTitle }}</td>
                    <td class="px-4 py-2">{{ Str::limit($inquiry->InquiryDescription, 50) }}</td>
                    <td class="px-4 py-2">{{ $inquiry->InquiryDate }}</td>
                    <td class="px-4 py-2">{{ $inquiry->InquiryStatus }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

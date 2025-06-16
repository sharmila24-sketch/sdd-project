@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Senarai Inkuiri</h2>

    @if ($inquiries->isEmpty())
        <p>Tiada inkuiri ditemui.</p>
    @else
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f3f3f3;">
                    <th style="padding: 10px; border: 1px solid #ccc;">Tajuk</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Keterangan</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Tarikh</th>
                    <th style="padding: 10px; border: 1px solid #ccc;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $inquiry)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ $inquiry->InquiryTitle }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ \Illuminate\Support\Str::limit($inquiry->InquiryDescription, 60) }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ $inquiry->InquiryDate }}</td>
                        <td style="padding: 10px; border: 1px solid #ccc;">{{ $inquiry->InquiryStatus }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

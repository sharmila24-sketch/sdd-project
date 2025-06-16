@extends('layouts.app')

@section('title', 'Past Inquiries')

@section('content')
<style>
    .past-inquiries-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .past-inquiries-wrapper h2 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .inquiry-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }

    .inquiry-card h4 {
        margin-top: 0;
        color: #007bff;
    }

    .inquiry-details {
        font-size: 15px;
        line-height: 1.6;
        color: #333;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        font-size: 13px;
        border-radius: 20px;
        font-weight: bold;
        color: white;
    }

    .status-Pending { background-color: orange; }
    .status-Valid { background-color: green; }
    .status-Rejected { background-color: red; }
    .status-Assigned { background-color: #17a2b8; }
</style>

<div class="past-inquiries-wrapper">
    <h2>Your Past Inquiries</h2>

    @forelse ($inquiries as $inquiry)
        <div class="inquiry-card">
            <h4>{{ $inquiry->InquiryTitle }}</h4>
            <div class="inquiry-details">
                <p><strong>Description:</strong> {{ $inquiry->InquiryDescription }}</p>
                <p><strong>Date Submitted:</strong> {{ \Carbon\Carbon::parse($inquiry->InquiryDate)->format('d M Y') }}</p>
                <p>
                    <strong>Status:</strong>
                    <span class="status-badge status-{{ $inquiry->InquiryStatus }}">
                        {{ $inquiry->InquiryStatus }}
                    </span>
                </p>
                @if ($inquiry->InquiryEvidance)
                    <p><strong>Evidence:</strong> 
                        <a href="{{ asset('storage/' . $inquiry->InquiryEvidance) }}" target="_blank">View Evidence</a>
                    </p>
                @endif
                @if ($inquiry->is_public)
                    <p><strong>Public:</strong> Yes</p>
                @else
                    <p><strong>Public:</strong> No</p>
                @endif
            </div>
        </div>
    @empty
        <p>No past inquiries found.</p>
    @endforelse
</div>
@endsection

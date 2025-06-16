@extends('layouts.app')

@section('content')
<style>
    .inquiry-wrapper {
        max-width: 700px;
        margin: 40px auto;
        background: #ffffff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .inquiry-wrapper h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #2c3e50;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
        color: #34495e;
    }

    .form-control,
    .form-select {
        width: 100%;
        border-radius: 8px;
        padding: 10px 14px;
        border: 1px solid #ccc;
        font-size: 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2980b9;
        outline: none;
        box-shadow: 0 0 4px rgba(41, 128, 185, 0.4);
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border-radius: 8px;
        background-color: #2980b9;
        border: none;
        font-weight: bold;
        color: white;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1c5980;
    }

    .alert-success {
        margin-bottom: 20px;
    }
</style>

<div class="inquiry-wrapper">
    <h2>Submit News Inquiry</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inquiries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="InquiryTitle">Title:</label>
            <input type="text" name="InquiryTitle" id="InquiryTitle" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="InquiryDescription">Description:</label>
            <textarea name="InquiryDescription" id="InquiryDescription" class="form-control" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="InquiryEvidance">Evidence File (optional):</label>
            <input type="file" name="InquiryEvidance" id="InquiryEvidance" class="form-control">
        </div>

        <label>Category:</label>
<input type="text" name="InquiryCategory" required>



        <div class="form-group">
            <label for="is_public">Is this public?</label>
            <select name="is_public" id="is_public" class="form-select" required>
                <option value="">-- Select Option --</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Inquiry</button>
    </form>
</div>
@endsection

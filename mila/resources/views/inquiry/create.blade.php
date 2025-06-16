@extends('layouts.app')

<form action="{{ route('inquiries.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Your Name or Email:</label>
    <input type="text" name="UserIdentity" required><br>

    <label>Title:</label>
    <input type="text" name="InquiryTitle" required><br>

    <label>Description:</label>
    <textarea name="InquiryDescription" required></textarea><br>

    <label>Evidence (optional):</label>
    <input type="file" name="InquiryEvidence"><br>

    <label>Make this inquiry public?</label>
    <input type="checkbox" name="is_public" value="1"><br>

    <button type="submit">Submit</button>
</form>
@extends('layouts.app')

@section('content')
<style>
    .form-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        background-color: #f5f7fa;
    }

    .inquiry-form {
        background-color: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
    }

    .inquiry-form h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    .inquiry-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #34495e;
    }

    .inquiry-form input[type="text"],
    .inquiry-form textarea,
    .inquiry-form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .inquiry-form input[type="checkbox"] {
        margin-right: 5px;
    }

    .inquiry-form button {
        background-color: #3498db;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .inquiry-form button:hover {
        background-color: #2980b9;
    }
</style>

<div class="form-wrapper">
    <form action="{{ route('inquiries.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <h2>Submit an Inquiry</h2>

        <label for="InquiryTitle">Title:</label>
        <input type="text" name="InquiryTitle" required>

        <label for="InquiryDescription">Description:</label>
        <textarea name="InquiryDescription" rows="5" required></textarea>

        <label for="InquiryEvidence">Evidence (optional):</label>
        <input type="file" name="InquiryEvidence">

        <label for="is_public">
            <input type="checkbox" name="is_public" value="1">
            Make this inquiry public?
        </label>

        <button type="submit">Submit</button>
    </form>
</div>
@endsection

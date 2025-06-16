@extends('layouts.app')

@section('title', 'Agency Assignments')

@section('content')

<style>
.assignments-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    width: 100%; 
    margin: 0;    
}

.assignment-card {
    border: 1px solid #ccc;
    padding: 1rem 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    background-color: #fff;
}


.inquiry-title {
    display: inline-block;
    background-color:rgba(0, 255, 60, 0.35);  
    color: black;
    padding: 12px 30px;
    border-radius: 6px;
    font-weight: 600;
    margin-bottom: 1rem;
}

.assignment-table {
    width: 100%;
    border-collapse: collapse;
     table-layout: fixed;
    text-align: left;
    border: 2px solid black;
}

.assignment-table thead tr {
    background-color: rgb(71, 131, 250);
    text-align: center;
}

.assignment-table th,
.assignment-table td {
    padding: 8px;
    border-bottom: 1px solid #ddd;
    color: white;
    text-align: center;
}

.assignment-table td {
    color: black;
} 
</style>

<h2>Agency Assignments</h2>

<div class="assignments-container">
    @foreach($assignments as $assignment)
        <div class="assignment-card">
            <div class="inquiry-title">
                {{ $assignment->inquiry->InquiryTitle ?? 'No Title' }}
            </div>
            <table class="assignment-table">
                <thead>
                    <tr>
                        <th>Inquiry ID</th>
                        <th>Assignment Date</th>
                        <th>Agency Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $assignment->InquiryID }}</td>
                        <td>{{ \Carbon\Carbon::parse($assignment->AssignmentDate)->format('d M Y') }}</td>
                        <td>{{ $assignment->agency->AgencyCompany ?? 'No Agency' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endforeach
</div>

@endsection

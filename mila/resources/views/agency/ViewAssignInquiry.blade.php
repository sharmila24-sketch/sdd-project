<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Inquiries</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8fafc;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            max-width: 900px;
            margin: auto;
        }
        h2 {
            color: #1d4ed8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background-color: #eff6ff;
            text-align: left;
        }
        .filter {
            margin-bottom: 20px;
        }
        .filter input, .filter select {
            padding: 6px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📌 Assigned Inquiries</h2>

        <form method="GET" class="filter">
            <input type="hidden" name="agency_id" value="{{ request('agency_id') }}">
            <select name="status">
                <option value="">-- All Status --</option>
                <option value="under investigation">Under Investigation</option>
                <option value="verified">Verified as True</option>
                <option value="fake">Identified as Fake</option>
                <option value="rejected">Rejected</option>
            </select>

            <input type="text" name="category" placeholder="Category..." value="{{ request('category') }}">
            <input type="date" name="start_date" value="{{ request('start_date') }}">
            <input type="date" name="end_date" value="{{ request('end_date') }}">
            <button type="submit">Filter</button>
        </form>

        @if(count($inquiries) > 0)
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inquiries as $inquiry)
                <tr>
                    <td>{{ $inquiry->InquiryTitle }}</td>
                    <td>{{ $inquiry->InquiryStatus }}</td>
                    <td>{{ $inquiry->InquiryCategory }}</td>
                    <td>{{ $inquiry->InquiryDate }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $inquiries->links() }}
        @else
            <p>No assigned inquiries found.</p>
        @endif
    </div>
</body>
</html>

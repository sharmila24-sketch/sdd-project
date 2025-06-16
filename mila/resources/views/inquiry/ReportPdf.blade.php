<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inquiry Report PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Inquiry Report ({{ ucfirst($filter) }})</h2>
    <table>
        <thead>
            <tr>
                <th>Period</th>
                <th>Total Inquiries</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inquiries as $inquiry)
            <tr>
                <td>{{ $inquiry->period }}</td>
                <td>{{ $inquiry->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

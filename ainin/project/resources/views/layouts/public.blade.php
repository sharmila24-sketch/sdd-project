<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FactTracker - Public</title>
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
</head>
<body class="public">
    <div class="sidebar">
        <h2 class="company-name">FactTracker.com</h2> <!-- Company name inside sidebar -->
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Submit Inquiry</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </div>

    <div class="main">
        <div class="header">
            <!-- No company name here -->
            <div class="user-icon"></div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>

</html>

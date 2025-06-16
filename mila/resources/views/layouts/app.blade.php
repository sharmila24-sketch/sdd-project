<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Facttrackers.com - @yield('title')</title>
<style>
    /* Reset and basic styles */
    body, html {
        margin: 0; padding: 0; height: 100%;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
    }

    /* Full-width header */
    header {
        height: 100px;
        background-color: #007bff; /* blue */
        color: white;
        display: flex;
        align-items: center;
        padding-left: 20px;
        flex-shrink: 0;
        width: 100%;
        box-sizing: border-box;
        /* No text here */
    }

    /* Wrapper for sidebar and main content */
    .main-wrapper {
        display: flex;
        flex-grow: 1;
        height: calc(100vh - 60px); /* full height minus header */
    }

    /* Sidebar */
    .sidebar {
        width: 280px;
        background-color: #007bff; /* same blue as header */
        color: white;
        display: flex;
        flex-direction: column;
        padding: 50px;
        box-sizing: border-box;
    }

    /* Company name in sidebar */
    .sidebar .company-name {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 50px;
        margin-top:-110px
    }

    /* Sidebar nav list */
    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        flex-grow: 1;
    }

    .sidebar ul li {
        margin-bottom: 30px;
    }

    .sidebar ul li a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        font-size: 20px;

    }

    .sidebar ul li a:hover {
        text-decoration: underline;
    }

    /* Main content */
    main.content {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
    }

    /* Role-based colors */
    .public-user {
        background-color: #007bff; /* Blue */
    }

    .mcmc-staff {
        background-color:rgb(229, 67, 67); /* Green */
    }

    .agency-user {
        background-color:rgb(255, 115, 0); /* Yellow/Amber */
        color: black; /* Make sure text is readable */
    }

    /* Optional: link hover color for yellow background */
    .agency-user a:hover {
        text-decoration: underline;
        color: black;
    }

    .agency-user .company-name {
    color: white;
    }
    /* Hide submenu by default */
    .submenu {
    display: none;
    margin-top: 5px;
    margin-bottom: 10px;
    padding-left: 15px; /* indent the whole submenu */
    list-style: none;
}

    .submenu li {
        margin-bottom: 15px; /* spacing like main items */
    }

    .submenu li a {
        font-size: 16px;
        font-weight: 500;
        color: white;
        text-decoration: none;
        display: block;
        margin-top:15px;
        padding-left: 50px; /* extra small indent for clarity */
    }


    /* Style submenu toggle cursor */
    .submenu-toggle {
        cursor: pointer;
        user-select: none;
        display: inline-block;
    }

    /* Optional: add a little indicator (arrow) */
    .submenu-toggle::after {
        content: " ▼"; /* down arrow */
        font-size: 0.7em;
        margin-left: 5px;
    }

    /* When submenu is open, rotate arrow */
    .submenu-toggle.active::after {
        content: " ▲"; /* up arrow */
    }

</style>
</head>

<body>
    <header class="{{ $sidebarClass ?? '' }}">
        <!-- Optional: You can put a user greeting or role name here -->
    </header>

    <div class="main-wrapper">
        <aside class="sidebar {{ $sidebarClass ?? '' }}">
        <div class="company-name">Facttrackers.com</div>
        <ul>
            @foreach ($sidebarItems ?? [] as $item)
                <li>
                    {{-- If has children, make parent clickable --}}
                    @if (isset($item['children']) && is_array($item['children']))
                        <a href="javascript:void(0)" class="submenu-toggle">{!! $item['label'] !!}</a>
                        <ul class="submenu">
                            @foreach ($item['children'] as $child)
                                <li><a href="{{ $child['url'] }}">{{ $child['label'] }}</a></li>
                            @endforeach
                        </ul>
                    @else
                        <a href="{{ $item['url'] }}">{!! $item['label'] !!}</a>
                    @endif
                </li>
            @endforeach
        </ul>
        </aside>



        <main class="content">
            @yield('content')
        </main>
    </div>


    <script>
    document.querySelectorAll('.submenu-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            this.classList.toggle('active');
            const submenu = this.nextElementSibling;
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
            } else {
                submenu.style.display = 'block';
            }
        });
    });
</script>

</body>
</html>
